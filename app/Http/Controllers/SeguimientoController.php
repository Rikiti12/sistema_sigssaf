<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Asignaciones;
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
        $asignaciones = Asignaciones::with('voceros')->get(); // Cargar la relación con tabla "personas"

        $asignaciones->each(function ($asignacion) {
            $asignacion->yaSeguimiento = Seguimientos::where('id_asignacion', $asignacion->id)->exists();
        });

        return view('seguimiento.index', compact('asignaciones'));
    }

    public function getAsignacionDetalles($id)
    {
        // Recupera el asigacion por su ID
        $asignacion = Asignaciones::find($id);

        if (!$asignacion) {
            // Maneja el caso en que no se encuentre la vocero
            return response()->json(['error' => 'Vocero no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'imagenes' => $asignacion->imagenes,
            'latitud' => $asignacion->latitud,
            'longitud' => $asignacion->longitud,
            'descri_alcance' => $asignacion->descri_alcance,
            'moneda_presu' => $asignacion->moneda_presu,
            'presupuesto' => $asignacion->presupuesto,
            'impacto_ambiental' => $asignacion->impacto_ambiental,
            'impacto_social' => $asignacion->impacto_social,
            'fecha_inicio' => $asignacion->fecha_inicio,
            'duracion_estimada' => $asignacion->duracion_estimada,
            // 'direccion' => $asignacion->direccion,
            // 'documentos' => $asignacion->documentos,
        ]);
 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $planificacion = Planificaciones::with('asignaciones.evaluaciones')->findOrFail($id);

        return view('seguimiento.create', compact('planificacion','respon_evalu')); // Pasar los proyectos a la vista
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
            $seguimientos->gasto = $request->input('gasto');
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
        // $planificacion = Planificaciones::findOrFail($id);
        // $respon_evalu = $seguimiento->planificacion->asignaciones->evaluaciones->respon_evalu;
        $responsable_segui = $seguimiento->responsable_segui;
        $fecha_segui = date('d/m/Y', strtotime($seguimiento->fecha_hor));
        return view('seguimiento.edit', compact('seguimiento','fecha_segui','responsable_segui')); 
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
            $seguimiento->id_planificacion = $request->input('id_planificacion');
            $seguimiento->fecha_hor = $request->input('fecha_hor');
            $seguimiento->responsable_segui = $request->input('responsable_segui');
            $seguimiento->detalle_segui = $request->input('detalle_segui');
            $seguimiento->gasto = $request->input('gasto');
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

