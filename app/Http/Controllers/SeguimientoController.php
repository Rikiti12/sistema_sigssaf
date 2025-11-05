<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Asignaciones;
use App\Models\ControlSeguimientos;
use App\Models\Visitas;
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
        $asignaciones = Asignaciones::all(); 

        // $asignaciones->each(function ($asignacion) {
        //     $asignacion->yaSeguimiento = Seguimientos::where('id_asignacion', $asignacion->id)->exists();
        // });

        return view('seguimiento.index', compact('asignaciones'));
    }

    public function getAsignacionDetalles($id)
    {
        // Recupera el asigacion por su ID
        $asignacion = Asignaciones::find($id);

        if (!$asignacion) {
            // Maneja el caso en que no se encuentre la vocero
            return response()->json(['error' => 'Asignacion no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_evaluacion' => $asignacion->id_evaluacion,
            'imagenes' => $asignacion->imagenes,
            'nombre_ayuda' => $asignacion->ayuda->nombre_ayuda,
            'tipo_ayuda' => $asignacion->ayuda->tipo_ayuda,
            
        ]);
 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $asignacion = Asignaciones::findOrFail($id);
        $visitas = Visitas::all();

        return view('seguimiento.create', compact('asignacion', 'visitas')); 
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
            $seguimientos->id_asignacion = $request->input('id_asignacion');
            $seguimientos->id_visita = $request->input('id_visita');
            $seguimientos->fecha_hor = $request->input('fecha_hor');
            $seguimientos->responsable_segui = $request->input('responsable_segui');
            $seguimientos->detalle_segui = $request->input('detalle_segui');
            $seguimientos->gasto = $request->input('gasto');
            $seguimientos->estado_actual = $request->input('estado_actual');
            $seguimientos->riesgos = $request->input('riesgos');

            $seguimientos->save();

            $puente = new ControlSeguimientos();
            $puente->id_seguimiento = $seguimientos->id; // Usamos el ID de lo seguimientos creada
            $puente->id_asignacion = $request->input('id_asignacion');
            $puente->save();

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seguimiento = Seguimientos::findOrFail($id);
        $visitas = Visitas::all();
        $responsable_segui = $seguimiento->responsable_segui;
        $fecha_segui = date('d/m/Y', strtotime($seguimiento->fecha_hor));
        return view('seguimiento.edit', compact('seguimiento','fecha_segui','responsable_segui','visitas')); 
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
            $seguimiento->id_asignacion = $request->input('id_asignacion');
            $seguimiento->fecha_hor = $request->input('fecha_hor');
            $seguimiento->responsable_segui = $request->input('responsable_segui');
            $seguimiento->id_visita = $request->input('id_visita');
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

}

