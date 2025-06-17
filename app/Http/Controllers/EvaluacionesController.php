<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluaciones;
use App\Models\Proyectos; // Asegúrate de que esta línea esté presente para usar el modelo Proyectos
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
        $evaluaciones = Evaluaciones::with('proyectos')->get();
        $proyectos = Proyectos::all(); 
        return view('evaluacion.create', compact('evaluaciones', 'proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyectos::all();
        return view('evaluacion.create', compact('proyectos'));
    }

    // ... resto de tu código (store, edit, update, etc.) ...


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
        $evaluaciones->respon_evalu = $request->input('respon_evalu');
        $evaluaciones->observaciones = $request->input('observaciones');
        $evaluaciones->estado_evalu = $request->input('estado_evalu');
        $evaluaciones->viabilidad = $request->input('viabilidad');

        $evaluaciones->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('asignacion.index')->with('success', 'Evaluación creada exitosamente');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $evaluacion = Evaluacion::with('proyecto')->findOrFail($id);
    //     return view('evaluacion.show', compact('evaluacion'));
    // }

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
       
        
        return view('evaluacion.edit', compact('evaluacion', 'proyectos'));
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
        $evaluacion->respon_evalu = $request->input('respon_evalu');
        $evaluacion->observaciones = $request->input('observaciones');
        $evaluacion->estado_evalu = $request->input('estado_evalu');
        $evaluacion->viabilidad = $request->input('viabilidad');

        // // Manejo de documentos adjuntos
        // if ($request->hasFile('documentos')) {
        //     $rutaGuardarDocs = 'documentos/evaluaciones/';
        //     $nuevosDocumentos = [];

        //     foreach ($request->file('documentos') as $documento) {
        //         $nombreDocumento = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($documento->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $documento->getClientOriginalExtension();
        //         $documento->move(public_path($rutaGuardarDocs), $nombreDocumento);
        //         $nuevosDocumentos[] = $nombreDocumento;
        //     }

        //     // Combinar con documentos existentes
        //     $documentosExistentes = json_decode($evaluacion->documentos, true) ?? [];
        //     $todosDocumentos = array_merge($documentosExistentes, $nuevosDocumentos);
            
        //     $evaluacion->documentos = json_encode($todosDocumentos);
        // }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $evaluacion = Evaluacion::findOrFail($id);
        
    //     try {
    //         $evaluacion->delete();
    //         $bitacora = new BitacoraController();
    //         $bitacora->update();
    //         return redirect()->route('evaluacion.index')->with('success', 'Evaluación eliminada exitosamente');
    //     } catch (QueryException $exception) {
    //         $errorMessage = 'Error: ' . $exception->getMessage();
    //         return redirect()->back()->withErrors($errorMessage);
    //     }
    // }

    /**
     * Generar PDF de la evaluación
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function pdf($id)
    // {
    //     $evaluacion = Evaluacion::with('proyecto')->findOrFail($id);
    //     $pdf = Pdf::loadView('evaluacion.pdf', compact('evaluacion'));
    //     return $pdf->download('evaluacion-' . $evaluacion->id . '.pdf');
    // }
}