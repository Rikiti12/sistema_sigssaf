<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Personas;
use App\Models\Comunidades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyectosController extends Controller
{  
    function __construct()
    {
         $this->middleware('permission:ver-proyecto|crear-proyecto|editar-ptoyecto|', ['only' => ['index']]);
         $this->middleware('permission:crear-proyecto', ['only' => ['create','store']]);
         $this->middleware('permission:editar-proyecto', ['only' => ['edit','update']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $proyectos = Proyectos::all();
        // return view('proyecto.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Personas::all();
        $comunidades = Comunidades::all();
        return view('proyecto.create', compact('personas', 'comunidades'));
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
        //     'nombre_pro' => 'required',
        //     'descripcion_pro' => 'required',
        //     'id_persona' => 'required|exists:personas,id',
        //     'id_comunidad' => 'required|exists:comunidades,id',
        //     'fecha_inicial' => 'required|date',
        // ]);

        $proyectos = new Proyectos();
        $proyectos->nombre_pro = $request->input('nombre_pro');
        $proyectos->descripcion_pro = $request->input('descripcion_pro');
        $proyectos->id_persona = $request->input('id_persona');
        $proyectos->id_comunidad = $request->input('id_comunidad');

        // Verificar si se han cargado archivos
        if ($request->hasFile('imagenes')) {
            $rutaGuardarImg = 'imagenes/';
            $nombresImagenes = [];

            foreach ($request->file('imagenes') as $foto) {
                $imagenProyecto = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenProyecto);
                $nombresImagenes[] = $imagenProyecto;
            }

            
            $proyectos->imagenes = json_encode($nombresImagenes);
        } else {
            $proyectos->imagenes = '[]'; // null
            
        }

        // // Verificar si se han cargado archivos
        // if ($request->hasFile('documentos')) {
        //     $rutaGuardarPdf = 'pdf/';
        //     $nombresPdf = [];

        //     foreach ($request->file('documentos') as $pdf) {
        //         $pdfProyecto = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $pdf->getClientOriginalExtension();
        //         $pdf->move(public_path($rutaGuardarPdf), $pdfProyecto);
        //         $nombresPdf[] = $pdfProyecto;
        //     }

        //     $proyectos->documentos = json_encode($nombresPdf);
        // } else {
        //     $proyectos->documentos = '[]'; // null
        // }

        $proyectos->fecha_inicial = $request->input('fecha_inicial');
        $proyectos->fecha_final = $request->input('fecha_final');

        $proyectos->save();

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
        $proyecto = Proyectos::find($id);
        $personas = Personas::all();
        $comunidades = Comunidades::all();
        $imagenes = $proyecto->imagenes;
        // $documentos = $proyecto->documentos;
        return view('proyecto.edit', compact('proyecto', 'personas', 'comunidades', 'imagenes'));
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

        $proyecto = Proyectos::find($id);
        $proyecto->nombre_pro = $request->input('nombre_pro');
        $proyecto->descripcion_pro = $request->input('descripcion_pro');
        $proyecto->id_persona = $request->input('id_persona');
        $proyecto->id_comunidad = $request->input('id_comunidad');

        // Verificar si se han cargado nuevos archivos
        if ($request->hasFile('imagenes')) {
            $rutaGuardarImg = 'imagenes/';
            $nombresImagenes = [];

            foreach ($request->file('imagenes') as $foto) {
                $imagenProyecto = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenProyecto);
                $nombresImagenes[] = $imagenProyecto;
            }

            // Actualizar las imágenes
            $proyecto->imagenes = json_encode($nombresImagenes);
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
        //     $archivosExistentes = json_decode($proyecto->documentos, true) ?? [];
        //     $todosLosArchivos = array_merge($archivosExistentes, $nuevosNombresPdf);

        //     $proyecto->documentos = json_encode($todosLosArchivos);
        // }


        $proyecto->fecha_inicial = $request->input('fecha_inicial');
        $proyecto->fecha_final = $request->input('fecha_final');

        $proyecto->save();

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