<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asignaciones;
use App\Models\Personas;
use App\Models\Comunidades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class AsignacionesController extends Controller
{  
    function __construct()
    {
         $this->middleware('permission:ver-asignacion|crear-asignacion|editar-ptoyecto|', ['only' => ['index']]);
         $this->middleware('permission:crear-asignacion', ['only' => ['create','store']]);
         $this->middleware('permission:editar-asignacion', ['only' => ['edit','update']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $asignaciones = asignaciones::all();
    //     return view('asignacion.index', compact('asignaciones'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Personas::all();
        $comunidades = Comunidades::all();
        return view('asignacion.create', compact('personas', 'comunidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'imagenes' => 'required|array|min:1',
        //     'imagenes' => 'image|nime:jpeg,png,jpg,gif,svg',
        //     'descripcion_pro' => 'required',
        //     'id_persona' => 'required|exists:personas,id',
        //     'id_comunidad' => 'required|exists:comunidades,id',
        //     'fecha_inicial' => 'required|date',
        // ], [
        //     'imagenes.required' => 'Debe registrar una o mas fotos.',
        //     'imagenes.required' => 'Las imagenes deben ser tipo jpeg, png, jpg, gif o svg.',
        // ]);

        $asignaciones = new Asignaciones();
        $asignaciones->id_persona = $request->input('id_persona');
        $asignaciones->id_comunidad = $request->input('id_comunidad');
        // $asignaciones->nombre_pro = $request->input('nombre_pro');
        // $asignaciones->descripcion_pro = $request->input('descripcion_pro');
        

        // Verificar si se han cargado archivos
        if ($request->hasFile('imagenes')) {
            $rutaGuardarImg = 'imagenes/';
            $nombresImagenes = [];

            foreach ($request->file('imagenes') as $foto) {
                $imagenAsignacion = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenAsignacion);
                $nombresImagenes[] = $imagenAsignacion;
            }

            
            $asignaciones->imagenes = json_encode($nombresImagenes);
        } else {
            $asignaciones->imagenes = '[]'; // null
            
        }

        $asignaciones->latitud = $request->input('latitud');
        $asignaciones->longitud = $request->input('longitud');
        $asignaciones->direccion = $request->input('direccion');
        $asignaciones->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('planificacion.index');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // No se usa

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignacion = Asignaciones::find($id);
        $personas = Personas::all();
        $comunidades = Comunidades::all();
        $imagenes = $asignacion->imagenes;
        $latitud = $asignacion->latitud;
        $longitud = $asignacion->longitud;
        $direccion = $asignacion->direccion;

        // $documentos = $asignacion->documentos;
        return view('asignacion.edit', compact('asignacion', 'personas', 'comunidades', 'imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nombre_pro' => 'required',
        //     'descripcion_pro' => 'required',
        //     'id_persona' => 'required|exists:personas,id',
        //     'id_comunidad' => 'required|exists:comunidades,id',
        //     'fecha_inicial' => 'required|date',
        // ]);

        $asignacion = Asignaciones::find($id);
        $asignacion->id_persona = $request->input('id_persona');
        $asignacion->id_comunidad = $request->input('id_comunidad');
        $asignacion->nombre_pro = $request->input('nombre_pro');
        $asignacion->descripcion_pro = $request->input('descripcion_pro');
       

        // Verificar si se han cargado nuevos archivos
        if ($request->hasFile('imagenes')) {
            $rutaGuardarImg = 'imagenes/';
            $nombresImagenes = [];

            foreach ($request->file('imagenes') as $foto) {
                $imagenAsignacion = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenAsignacion);
                $nombresImagenes[] = $imagenAsignacion;
            }

            // Actualizar las imágenes
            $asignacion->imagenes = json_encode($nombresImagenes);
        }

        // // Verificar si se han cargado nuevos archivos
        // if ($request->hasFile('documentos')) {
        //     $rutaGuardarPdf = 'pdf/';
        //     $nuevosNombresPdf = [];

        //     foreach ($request->file('documentos') as $pdf) {
        //         $pdfComprobante = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $pdf->getClientOriginalExtension();
        //         $pdf->move(public_path($rutaGuardarPdf), $pdfComprobante);
        //         $nuevosNombresPdf[] = $pdfComprobante;
        //     }

        //     // Combinar los nuevos archivos con los existentes
        //     $archivosExistentes = json_decode($asignacion->documentos, true) ?? [];
        //     $todosLosArchivos = array_merge($archivosExistentes, $nuevosNombresPdf);

        //     $asignacion->documentos = json_encode($todosLosArchivos);
        // }
       
        $asignacion->latitud = $request->input('latitud');
        $asignacion->longitud = $request->input('longitud');
        $asignacion->direccion = $request->input('direccion');

        $asignacion->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('planificacion');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Proyecto::find($id)->delete();
        // $bitacora = new BitacoraController();
        // $bitacora->update();
        // return redirect()->route('proyecto.index')->with('eliminar', 'ok');
    }  

}    