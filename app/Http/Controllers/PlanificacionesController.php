<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planificaciones;
use App\Models\Proyectos;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;


class PlanificacionesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-planificacion|crear-planificacion|editar-planificacion|', ['only' => ['index']]);
        $this->middleware('permission:crear-planificacion', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-planificacion', ['only' => ['edit', 'update']]);
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Proyectos::with('personas')->get(); // Cargar la relación con tabla "personas"
        return view('planificacion.index', compact('proyectos'));
    }

    public function getProyectoDetalles($id)
    {
        // Recupera el Proyecto por su ID
        $proyecto = Proyectos::find($id);

        if (!$proyecto) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'imagenes' => $proyecto->imagenes,
            'latitud' => $proyecto->latitud,
            'longitud' => $proyecto->longitud,
            'direccion' => $proyecto->direccion,
            // 'documentos' => $proyecto->documentos,
        ]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $proyecto = Proyectos::findOrFail($id);
        return view('planificacion.create', compact('proyecto'));
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

        $planificaciones = new Planificaciones();
        $planificaciones->id_proyecto = $request->input('id_proyecto');
        $planificaciones->descri_alcance = $request->input('descri_alcance');
        $planificaciones->presupuesto = $request->input('presupuesto');
        $planificaciones->impacto_ambiental = $request->input('impacto_ambiental');
        $planificaciones->impacto_social = $request->input('impacto_social');
        $planificaciones->descri_obra = $request->input('descri_obra');
        $planificaciones->fecha_inicio = $request->input('fecha_inicio');
        $planificaciones->duracion_estimada = $request->input('duracion_estimada');

        // dd($planificaciones->id_proyecto);

        $planificaciones->save();

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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planificacion = Planificaciones::find($id);
        $proyectos = Proyectos::all();
        return view('planificacion.edit', compact('planificacion','proyectos'));
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

        $planificacion = Planificaciones::find($id);
        $planificacion->id_proyecto = $request->input('id_proyecto');
        $planificacion->descri_alcance = $request->input('descri_alcance');
        $planificacion->presupuesto = $request->input('presupuesto');
        $planificacion->impacto_ambiental = $request->input('impacto_ambiental');
        $planificacion->impacto_social = $request->input('impacto_social');
        $planificacion->descri_obra = $request->input('descri_obra');
        $planificacion->fecha_inicio = $request->input('fecha_inicio');
        $planificacion->duracion_estimada = $request->input('duracion_estimada');

        $planificacion->save();

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
        // No es peo tuyo vale XD 
    }

}
