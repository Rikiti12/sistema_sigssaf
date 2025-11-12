<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluaciones;
use App\Models\Proyectos; 
use App\Models\Resposanbles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluacionesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-evaluacion|crear-evaluacion|editar-evaluacion|', ['only' => ['index']]);
        $this->middleware('permission:crear-evaluacion', ['only' => ['create','store']]);
        $this->middleware('permission:editar-evaluacion', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyectos::all();
        $resposanbles = Resposanbles::all();
        return view('evaluacion.create', compact('proyectos','resposanbles'));
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
        //     'id_proyecto' => 'required|exists:proyectos,id',
        //     'fecha_evalu' => 'required|date',
        //     'respon_evalu' => 'required|string|max:100',
        //     'observaciones' => 'required|string',
        //     'estado_evalu' => 'required|in:Pendiente,En Proceso,Completada,Aprobada',
        //     'viabilidad' => 'required|in:Alta,Media,Baja',
        //     'documentos' => 'nullable|array',
        //     'documentos.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048'
        // ]);

        $evaluaciones = new Evaluaciones();
        $evaluaciones->id_proyecto = $request->input('id_proyecto');
        $evaluaciones->fecha_evalu = $request->input('fecha_evalu');
        $evaluaciones->id_resposanble = $request->input('id_resposanble');
        $evaluaciones->observaciones = $request->input('observaciones');
        $evaluaciones->estatus = $request->input('estatus');
       
        $viabilidadInput = $request->input('viabilidad');

        switch ($viabilidadInput) {
            case 'Alta':
                $evaluaciones->viabilidad = 'Alta 100%';
                break;
            case 'Media':
                $evaluaciones->viabilidad = 'Media 50%';
                break;
            case 'Baja':
                $evaluaciones->viabilidad = 'Baja 25%';
                break;
            default:
     
       
        return redirect()->back()->withErrors(['viabilidad' => 'El valor de viabilidad no es válido.']);
    }
       
        $evaluaciones->estatus = $request->input('estatus');
       $evaluaciones->estatus_resp = $request->input('estatus_resp');

         if ($evaluaciones->estatus == "Aprobado") {

                if ($evaluaciones->estatus_resp = '') {
                    $evaluaciones->estatus_resp = 'Pendiente';
                }else{
                    $evaluaciones->estatus_resp = $request->input('estatus_resp');
                }
            } else {
                $evaluaciones->estatus_resp = 'Negado';
            }

          $evaluaciones->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('asignacion.index')->with('success', '✅ la Evaluacion ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }
    }

    public function actualizarEstatusEvaluacion(Request $request, $id)
    {
        $evaluacion = Evaluaciones::find($id);

        if ($evaluacion) {
            $evaluacion->estatus_resp = $request->input('estatus_resp');
            $evaluacion->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'evaluacion no encontrada']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluacion = Evaluaciones::findOrFail($id);
        $proyectos = Proyectos::all();
        $resposanbles = Resposanbles::all();

        return view('evaluacion.edit', compact('evaluacion', 'proyectos','resposanbles'));
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
        //     'id_proyecto' => 'required|exists:proyectos,id',
        //     'fecha_evalu' => 'required|date',
        //     'respon_evalu' => 'required|string|max:100',
        //     'observaciones' => 'required|string',
        //     'estado_evalu' => 'required|in:Pendiente,En Proceso,Completada,Aprobada',
        //     'viabilidad' => 'required|in:Alta,Media,Baja',
        //     'documentos' => 'nullable|array',
        //     'documentos.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:2048'
        // ]);

        $evaluacion = Evaluaciones::findOrFail($id);
        $evaluacion->id_proyecto = $request->input('id_proyecto');
        $evaluacion->fecha_evalu = $request->input('fecha_evalu');
        $evaluacion->id_resposanble = $request->input('id_resposanble');
        $evaluacion->observaciones = $request->input('observaciones');
        $evaluacion->estatus = $request->input('estatus');
       
        $viabilidadInput = $request->input('viabilidad');

        switch ($viabilidadInput) {
            case 'Alta':
                $evaluacion->viabilidad = 'Alta 100%';
                break;
            case 'Media':
                $evaluacion->viabilidad = 'Media 50%';
                break;
            case 'Baja':
                $evaluacion->viabilidad = 'Baja 25%';
                break;
            default:
       
        return redirect()->back()->withErrors(['viabilidad' => 'El valor de viabilidad no es válido.']);
    }
    
        // // Manejo de documentos adjuntos
        if ($request->hasFile('documentos')) {
            $rutaGuardarDocs = 'documentos/evaluaciones/';
            $nuevosDocumentos = [];

            foreach ($request->file('documentos') as $documento) {
                $nombreDocumento = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($documento->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $documento->getClientOriginalExtension();
                $documento->move(public_path($rutaGuardarDocs), $nombreDocumento);
                $nuevosDocumentos[] = $nombreDocumento;
            }

            // Combinar con documentos existentes
            $documentosExistentes = json_decode($evaluacion->documentos, true) ?? [];
            $todosDocumentos = array_merge($documentosExistentes, $nuevosDocumentos);
            
            $evaluacion->documentos = json_encode($todosDocumentos);
        }

        $evaluacion->estatus = $request->input('estatus');
        $evaluacion->estatus_resp = $request->input('estatus_resp');

        if ($evaluacion->estatus == "Aprobado") {

            if ($evaluacion->estatus_resp = '') {
                $evaluacion->estatus_resp = 'Pendiente';
            }else{
                $evaluacion->estatus_resp = $request->input('estatus_resp');
            }
           
        } else {
            $evaluacion->estatus_resp = 'Negado';
        }

        $evaluacion->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('asignacion.index')->with('success', 'Evaluación actualizada exitosamente');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }
    }

}