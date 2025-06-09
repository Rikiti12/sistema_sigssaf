<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyectos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyectosController extends Controller
{  
    function __construct()
    {
         $this->middleware('permission:ver-proyecto|crear-proyecto|editar-proyecto|borrar-proyecto', ['only' => ['index']]);
         $this->middleware('permission:crear-proyecto', ['only' => ['create','store']]);
         $this->middleware('permission:editar-proyecto', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-proyecto', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Proyectos::all();
        return view('proyecto.index', compact('proyectos'));
    }

     public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $proyectos = Proyectos::where('nombre_pro', 'LIKE', '%' . $search . '%')
                           ->orWhere('descripcion_pro', 'LIKE', '%' . $search . '%')
                           ->orWhere('tipo_pro', 'LIKE', '%' . $search . '%')
                           ->orWhere('fecha_inicial', 'LIKE', '%' . $search . '%')
                           ->orWhere('fecha_final', 'LIKE', '%' . $search . '%')
                           ->orWhere('prioridad', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $proyectos = Proyectos::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('proyecto.pdf', compact('proyectos'));
        return $pdf->stream('proyecto.pdf');
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyecto.create');
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
            'nombre_pro' => 'required|string|max:150',
            'descripcion_pro' => 'nullable|string',
            'tipo_pro' => 'required|in:Infraestructura,Social,Educativo,Salud,Ambiental,Otro',
            'fecha_inicial' => 'required|date',
            'fecha_final' => 'required|date|after_or_equal:fecha_inicial',
            'prioridad' => 'required|in:Alta,Media,Baja'
        ]);
            $proyectos = new Proyectos();
            $proyectos->nombre_pro = $request->input('nombre_pro');
            $proyectos->descripcion_pro = $request->input('descripcion_pro');
            $proyectos->tipo_pro = $request->input('tipo_pro');
            $proyectos->fecha_inicial = $request->input('fecha_inicial');
            $proyectos->fecha_final = $request->input('fecha_final');
            $proyectos->prioridad = $request->input('prioridad');
            $proyectos->save();

            // Registrar en bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();

        try {
            return redirect()->route('proyecto.index');
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
        // $proyecto = Proyecto::findOrFail($id);
        // return view('proyecto.show', compact('proyecto'));
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
        return view('proyecto.edit', compact('proyecto'));
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
            'nombre_pro' => 'required|string|max:150',
            'descripcion_pro' => 'nullable|string',
            'tipo_pro' => 'required|in:Infraestructura,Social,Educativo,Salud,Ambiental,Otro',
            'fecha_inicial' => 'required|date',
            'fecha_final' => 'required|date|after_or_equal:fecha_inicial',
            'prioridad' => 'required|in:Alta,Media,Baja',
            
        ]);
            $proyecto = Proyectos::find($id);
            $proyecto->nombre_pro = $request->input('nombre_pro');
            $proyecto->descripcion_pro = $request->input('descripcion_pro');
            $proyecto-> tipo_pro= $request->input('tipo_pro');
            $proyecto->fecha_inicial = $request->input('fecha_inicial');
            $proyecto->fecha_final = $request->input('fecha_final');
            $proyecto->prioridad = $request->input('prioridad');
            $proyecto->save();
        
            // Registrar en bitácora
           $bitacora = new BitacoraController();
        $bitacora->update();
        

        try {
            return redirect('proyecto');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        Proyectos::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('proyecto.index')->with('eliminar', 'ok');
    }
}

    