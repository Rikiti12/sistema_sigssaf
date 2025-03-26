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
        $request->validate([
            'nombre_pro' => 'required',
            'descripcion_pro' => 'required',
            'id_persona' => 'required|exists:personas,id',
            'id_comunidad' => 'required|exists:comunidades,id',
            'fecha_inicial' => 'required|date',
        ]);

        $proyectos = new Proyectos();
        $proyectos->nombre_pro = $request->input('nombre_pro');
        $proyectos->descripcion_pro = $request->input('descripcion_pro');
        $proyectos->id_persona = $request->input('id_persona');
        $proyectos->id_comunidad = $request->input('id_comunidad');
        $proyectos->fecha_inicial = $request->input('fecha_inicial');

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
        return view('proyecto.edit', compact('proyecto', 'personas', 'comunidades'));
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
        $proyecto->fecha_inicial = $request->input('fecha_inicial');

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