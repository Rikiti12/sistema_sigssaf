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

     public function getPlanificacionDetalles($id)
    {
        // Recupera el Planificacion por su ID
        $planificacion = Planificaciones::find($id);

        if (!$planificacion) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'impacto_ambiental' => $planificacion->impacto_ambiental,
            'impacto_social' => $planificacion->impacto_social,
            
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
            // Crear un nuevo seguimiento
            $seguimientos = new Seguimientos();
            $seguimientos->id_planificacion = $request->input('id_planificacion');
            $seguimientos->fecha_hor = $request->input('fecha_hor');
            $seguimientos->responsable_segui = $request->input('responsable_segui');
            $seguimientos->detalle_segui = $request->input('detalle_segui');
            $seguimientos->gasto_incu = $request->input('gasto_incu');
            $seguimientos->estado_actual = $request->input('estado_actual');
            $seguimientos->riesgos = $request->input('riesgos');
            $seguimientos->save();

            // $seguimientos->estatus = $request->input('estatus');

            //     if($seguimientos->estatus ==="Aprobado") {
            //         if ($seguimientos->estatus_res = '') {
            //             $seguimientos->estatus_res = 'Pendiente';
            //         }else{
            //             $seguimientos->estatus_res = $request->input('estatus_res');
            //         }
            //     }else{
            //         $seguimientos->estatus_res = 'Negado';
            //     }

            // $administradores = User::role('Administrador')->get();
           
            

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
 
    // public function actualizarEstatusSeguimiento(Request $request, $id)
    // {
    //     $seguimiento = Seguimientos::find($id);

    //     if ($seguimiento) {
    //         $seguimiento->estatus_res = $request->input('estatus_res');
    //         $seguimiento->save();

    //         return response()->json(['success' => true]);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Seguimiento no encontrada']);
    //     }
    // }
    
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
        $fecha_segui = date('d/m/Y', strtotime($seguimiento->fecha_hor));
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
            // $seguimiento->id_proyecto = $request->input('id_proyecto');
            $seguimiento->fecha_hor = $request->input('fecha_hor');
            $seguimiento->responsable_segui = $request->input('responsable_segui');
            $seguimiento->detalle_segui = $request->input('detalle_segui');
            $seguimiento->gasto_incu = $request->input('gasto_incu');
            $seguimiento->estado_actual = $request->input('estado_actual');
            $seguimiento->riesgos = $request->input('riesgos');
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

