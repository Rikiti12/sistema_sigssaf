<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asignaciones;
use App\Models\Evaluaciones;
use App\Models\Voceros;
use App\Models\Comunidades;
use App\Models\Ayudas;
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
        $evaluaciones = Evaluaciones::all();
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
        $ayudas = Ayudas::all();
        return view('asignacion.create', compact('evaluacion','voceros', 'comunidades', 'ayudas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $asignaciones = new Asignaciones();
        $asignaciones->id_evaluacion = $request->input('id_evaluacion');
        $asignaciones->id_vocero = $request->input('id_vocero');
        $asignaciones->id_comunidad = $request->input('id_comunidad');
        $asignaciones->id_ayuda = $request->input('id_ayuda');
        
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
        $asignaciones->fecha_inicio = $request->input('fecha_inicio');
        $asignaciones->duracion_estimada = $request->input('duracion_estimada');

        $asignaciones->latitud = $request->input('latitud');
        $asignaciones->longitud = $request->input('longitud');
        $asignaciones->direccion = $request->input('direccion');

        // dd($asignaciones->id_evaluacion);

        $asignaciones->save();

        //$bitacora = new BitacoraController();
        //$bitacora->update();

        try {
            return redirect()->route('seguimiento.index')->with('success', 'Asignación creada exitosamente.');
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
        // $asignacion = Asignaciones::findOrFail($id);
         $asignacion = Asignaciones::with('evaluacion')->findOrFail($id); 
        // $evaluacion = Evaluaciones::find($id);
        $evaluacion = $asignacion->evaluacion; 
        $voceros = Voceros::all();
        $comunidades = Comunidades::all();
        $ayudas = Ayudas::all();
        $imagenes = $asignacion->imagenes;
        $latitud = $asignacion->latitud;
        $longitud = $asignacion->longitud;
        $direccion = $asignacion->direccion;

        return view('asignacion.edit', compact('evaluacion','asignacion', 'voceros', 'comunidades', 'ayudas', 'imagenes','latitud','longitud','direccion'));
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

        $asignacion = Asignaciones::findOrFail($id);
        $asignacion->id_evaluacion = $request->input('id_evaluacion');
        $asignacion->id_vocero = $request->input('id_vocero');
        $asignacion->id_comunidad = $request->input('id_comunidad');
        $asignacion->id_ayuda = $request->input('id_ayuda');
       
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