<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planificaciones;
use App\Models\Proyectos;
use App\Models\Personas;
use App\Models\Comunidades;
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
        $planificaciones = Planificaciones::all();
        return view('proyecto.index', compact('planificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyectos::all();
        $personas = Personas::all();
        $comunidades = Comunidades::all();
        return view('planificacion.create', compact('proyectos', 'personas', 'comunidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_pro' => 'required',
            'descripcion_pro' => 'required',
            'id_persona' => 'required|exists:personas,id',
            'id_comunidad' => 'required|exists:comunidades,id',
            'fecha_inicial' => 'required|date',
        ]);

        $planificaciones = new Planificaciones();
        $planificaciones->nombre_pro = $request->input('nombre_pro');
        $planificaciones->descripcion_pro = $request->input('descripcion_pro');
        $planificaciones->id_persona = $request->input('id_persona');
        $planificaciones->id_comunidad = $request->input('id_comunidad');
        $planificaciones->fecha_inicial = $request->input('fecha_inicial');

        $planificaciones->save();

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
         $planificacion = Planificaciones::find($id);
         if (!$planificacion) {
             return redirect()->route('planificacion.index')->withErrors('Planificación no encontrada.');
        }
         return view('planificacion.show', compact('planificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planificaciones = Planificaciones::find($id);
        $proyectos = Proyectos::all();
        $personas = Personas::all();
        $comunidades = Comunidades::all();
        return view('planificacion.edit', compact('planificaciones','proyectos', 'personas', 'comunidades'));
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
        $request->validate([
            'nombre_pro' => 'required',
            'descripcion_pro' => 'required',
            'id_persona' => 'required|exists:personas,id',
            'id_comunidad' => 'required|exists:comunidades,id',
            'fecha_inicial' => 'required|date',
        ]);

        $planificacion = Planificaciones::find($id);
        $planificacion->nombre_pro = $request->input('nombre_pro');
        $planificacion->descripcion_pro = $request->input('descripcion_pro');
        $planificacion->id_persona = $request->input('id_persona');
        $planificacion->id_comunidad = $request->input('id_comunidad');
        $planificacion->fecha_inicial = $request->input('fecha_inicial');

        $planificacion->save();

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
        Planificaciones::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('planificacion.index')->with('eliminar', 'ok');
    }

}
