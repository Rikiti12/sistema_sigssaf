<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asignaciones;
use App\Models\Evaluaciones;
use App\Models\Voceros;
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
    public function index()
    {
        $evaluaciones = Evaluaciones::with('proyectos')->get();
        $evaluaciones->each(function ($evaluacion) {
            $evaluacion->yaAsignada = Asignaciones::where('id_evaluacion', $evaluacion->id)->exists();
        });

        return view('asignacion.index', compact('evaluaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $evaluacion = Evaluaciones::findOrFail($id);
        $voceros = Voceros::all();
        $comunidades = Comunidades::all();
        return view('asignacion.create', compact('evaluacion','voceros', 'comunidades'));
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
        $asignaciones->id_evaluacion = $request->input('id_evaluacion');
        $asignaciones->id_vocero = $request->input('id_vocero');
        $asignaciones->id_comunidad = $request->input('id_comunidad');
        
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

        $asignaciones->descri_alcance = $request->input('descri_alcance');
        $asignaciones->moneda_presu = $request->input('moneda_presu');
        $asignaciones->presupuesto = $request->input('presupuesto');
        $asignaciones->impacto_ambiental = $request->input('impacto_ambiental');
        $asignaciones->impacto_social = $request->input('impacto_social');
        // $asignaciones->descri_obra = $request->input('descri_obra');
        $asignaciones->fecha_inicio = $request->input('fecha_inicio');
        $asignaciones->duracion_estimada = $request->input('duracion_estimada');

        $asignaciones->latitud = $request->input('latitud');
        $asignaciones->longitud = $request->input('longitud');
        $asignaciones->direccion = $request->input('direccion');

        // dd($asignaciones);

        $asignaciones->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('seguimiento.index');
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
        $evaluacion = Evaluaciones::all();
        $voceros = Voceros::all();
        $comunidades = Comunidades::all();
        $imagenes = $asignacion->imagenes;
        $latitud = $asignacion->latitud;
        $longitud = $asignacion->longitud;
        $direccion = $asignacion->direccion;

        // $documentos = $asignacion->documentos;
        return view('asignacion.edit', compact('evaluacion','asignacion', 'voceros', 'comunidades', 'imagenes','latitud','longitud','direccion'));
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
        $asignacion->id_evaluacion = $request->input('id_evaluacion');
        $asignacion->id_vocero = $request->input('id_vocero');
        $asignacion->id_comunidad = $request->input('id_comunidad');
       
       

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

        $asignacion->descri_alcance = $request->input('descri_alcance');
        $asignacion->moneda_presu = $request->input('moneda_presu');
        $asignacion->presupuesto = $request->input('presupuesto');
        $asignacion->impacto_ambiental = $request->input('impacto_ambiental');
        $asignacion->impacto_social = $request->input('impacto_social');
        // $asignacion->descri_obra = $request->input('descri_obra');
        $asignacion->fecha_inicio = $request->input('fecha_inicio');
        $asignacion->duracion_estimada = $request->input('duracion_estimada');
       
        $asignacion->latitud = $request->input('latitud');
        $asignacion->longitud = $request->input('longitud');
        $asignacion->direccion = $request->input('direccion');

        $asignacion->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('seguimiento');
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