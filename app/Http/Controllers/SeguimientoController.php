<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Planificaciones;
use App\Models\Proyectos;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;

class SeguimientoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-seguimiento|crear-seguimiento|editar-ptoyecto|', ['only' => ['index']]);
         $this->middleware('permission:crear-seguimiento', ['only' => ['create','store']]);
         $this->middleware('permission:editar-seguimiento', ['only' => ['edit','update']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planificaciones = Planificaciones::all();
        return view ('seguimiento.index', compact('planificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $planificacion = Planificaciones::findOrFail($id);
        return view('seguimiento.create', compact('planificacion')); // Pasar los proyectos a la vista
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
        //     'id_proyecto' => 'required|exists:proyectos,id', // Validación para el proyecto
        //     'fecha_segui' => 'required|date',
        //     'responsable_segui' => 'required|string|max:255',
        //     'detalle_segui' => 'nullable|string',
        //     'estatus_proye' => 'nullable|string|max:50',
        // ]);

       
            // Crear un nuevo seguimiento
            $seguimientos = new Seguimientos();
            $seguimientos->id_planificacion = $request->input('id_planificacion');
            $seguimientos->fecha_segui = $request->input('fecha_segui');
            $seguimientos->responsable_segui = $request->input('responsable_segui');
            $seguimientos->detalle_segui = $request->input('detalle_segui');

            $seguimientos->estatus = $request->input('estatus');

                if($seguimientos->estatus ==="Aprobado") {
                    if ($seguimientos->estatus_res = '') {
                        $seguimientos->estatus_res = 'Pendiente';
                    }else{
                        $seguimientos->estatus_res = $request->input('estatus_res');
                    }
                }else{
                    $seguimientos->estatus_res = 'Negado';
                }

            $administradores = User::role('Administrador')->get();
           
            $seguimientos->save();

            // Registrar en la bitácora
            $bitacora = new BitacoraController();
             $bitacora->update();
             
         try {
            return redirect('controlseguimiento');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: .';
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
        $seguimiento = Seguimientos::findOrFail($id); // Buscar el seguimiento por ID
        return view('seguimiento.show', compact('seguimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seguimiento = Seguimientos::findOrFail($id);
        $proyectos = Proyectos::all();
        return view('seguimiento.edit', compact('seguimiento', 'proyectos')); 
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
        //     'id_proyecto' => 'required|exists:proyectos,id', //valido el id del proyecto
        //     'fecha_segui' => 'required|date',
        //     'responsable_segui' => 'required|string|max:255',
        //     'detalle_segui' => 'nullable|string',
        //     'estatus_proye' => 'nullable|string|max:50',
        // ]);
         
            $seguimiento = Seguimientos::findOrFail($id);
            $seguimiento->id_proyecto = $request->input('id_proyecto');
            $seguimiento->fecha_segui = $request->input('fecha_segui');
            $seguimiento->responsable_segui = $request->input('responsable_segui');
            $seguimiento->detalle_segui = $request->input('detalle_segui');
            $seguimiento->estatus_proye = $request->input('estatus_proye');
            $seguimiento->save();

            // Registrar en la bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();
        try {
            return redirect('controlseguimiento');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: .';
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
        // try {
        //     // Buscar el seguimiento a eliminar
        //     $seguimiento = Seguimientos::findOrFail($id);
        //     $seguimiento->delete();

        //     // Registrar en la bitácora
        //     $bitacora = new BitacoraController();
        //     $bitacora->registrarAccion("Se eliminó el seguimiento con ID: " . $id);

        //     // Mensaje de éxito
        //     return redirect()->route('seguimiento.index')->with('success', 'Seguimiento eliminado exitosamente.');
        // } catch (QueryException $e) {
        //      Log::error('Error al eliminar seguimiento: ' . $e->getMessage());
        //     return redirect()->route('seguimiento.index')->with('error', 'Ocurrió un error al eliminar el seguimiento: ' . $e->getMessage());
        // }
    }
}

