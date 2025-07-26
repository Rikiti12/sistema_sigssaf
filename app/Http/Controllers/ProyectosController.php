<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proyectos;
use App\Models\Ayudas;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;  

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
        $proyectos = Proyectos::with('ayuda')->get();
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
    
    public function getproyectoDetalles($id)
    {
        // Recupera el Proyecto por su ID
        $proyecto = Proyectos::find($id);

        if (!$proyecto) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'actividades' => $proyecto->actividades,
            'acta_conformidad' => $proyecto->acta_conformidad,
            'nombre_ayuda' => $proyecto->ayuda->nombre_ayuda,
            'tipo_ayuda' => $proyecto->ayuda->tipo_ayuda,
        ]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ayudas = Ayudas::all();
        return view('proyecto.create', compact('ayudas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'fecha_inicial' => trim($request->input('fecha_inicial')),
            'fecha_final' => trim($request->input('fecha_final')),
        ]);

        // Formateamos la fecha de hoy para usarla en las reglas 'after_or_equal' y 'before_or_equal'
        $todayFormatted = Carbon::today()->format('d/m/Y');

        // 2. Realizar la validación directamente en el controlador.
        // El método validate() lanzará una excepción y redirigirá si falla.
        $this->validate($request, [
            'fecha_inicial' => [
                'required',
                'date_format:d/m/Y', // Formato estricto DD/MM/YYYY
                'after_or_equal:' . $todayFormatted, // Debe ser hoy o después
                'before_or_equal:' . $todayFormatted, // Debe ser hoy o antes
                // Con estas dos reglas, fecha_inicial DEBE ser exactamente la fecha de hoy.
            ],
            'fecha_final' => [
                'required',
                'date_format:d/m/Y', // Formato estricto DD/MM/YYYY
                'after_or_equal:fecha_inicial', // La fecha final debe ser igual o posterior a la fecha inicial (hoy)
                // Regla personalizada para verificar que esté dentro de los 7 días hábiles.
                function ($attribute, $value, $fail) use ($request) {
                    try {
                        // Carbon::createFromFormat necesita el formato exacto.
                        // Gracias al trim() y date_format previo, esto debería ser seguro.
                        $fechaInicial = Carbon::createFromFormat('d/m/Y', $request->input('fecha_inicial'));
                        $fechaFinal = Carbon::createFromFormat('d/m/Y', $value);
                    } catch (\Exception $e) {
                        // Este catch es una capa de seguridad. Si el error "Trailing data" aún ocurre aquí,
                        // significa que el input no pasó la validación date_format correctamente o hay algo más.
                        $fail('Error interno al procesar las fechas. Asegúrate de que el formato sea DD/MM/YYYY y no contenga caracteres extraños.');
                        return;
                    }

                    // Calcular la fecha máxima permitida (7 días hábiles después de fecha_inicial)
                    $maxAllowedDate = $fechaInicial->copy();
                    $diasHabilesContados = 0;

                    // Bucle para encontrar el día hábil número 7
                    while ($diasHabilesContados < 7) {
                        if (!$maxAllowedDate->isWeekend()) { // Si no es sábado ni domingo
                            $diasHabilesContados++;
                        }
                        // Avanza al siguiente día, a menos que ya hayamos contado los 7 días y estemos en el último día hábil.
                        if ($diasHabilesContados < 7) {
                            $maxAllowedDate->addDay();
                        }
                    }
                    
                    // Ahora $maxAllowedDate es la fecha del 7mo día hábil (inclusive) desde $fechaInicial.
                    // Verificamos si $fechaFinal es posterior a esta fecha límite.
                    if ($fechaFinal->gt($maxAllowedDate)) {
                        $fail('La fecha final no puede exceder los 7 días hábiles después de la fecha inicial.');
                    }
                },
            ],
        ],
        // Mensajes personalizados para la validación
        [
            'fecha_inicial.required' => 'La fecha inicial es obligatoria.',
            'fecha_inicial.date_format' => 'La fecha inicial debe tener el formato DD/MM/YYYY.',
            'fecha_inicial.after_or_equal' => 'La fecha inicial debe ser la fecha actual (hoy).',
            'fecha_inicial.before_or_equal' => 'La fecha inicial debe ser la fecha actual (hoy).',

            'fecha_final.required' => 'La fecha final es obligatoria.',
            'fecha_final.date_format' => 'La fecha final debe tener el formato DD/MM/YYYY.',
            'fecha_final.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicial.',
            // El mensaje para la regla personalizada se define dentro del closure.
        ]);

        // Si la validación pasa, el código continúa aquí.
        // Accede a los datos del request directamente, ya que no estamos usando validated()
        // (el método validate() del controlador ya se encargó de la validación).
        $fechaInicialInput = $request->input('fecha_inicial');
        $fechaFinalInput = $request->input('fecha_final');

        $proyectos = new Proyectos();
        $proyectos->nombre_pro = $request->input('nombre_pro');
        $proyectos->descripcion_pro = $request->input('descripcion_pro');
        $proyectos->tipo_pro = $request->input('tipo_pro');

        // Asociar las actividades al proyecto
        // $proyectos->actividades()->sync($request->actividades);

        // $proyectos->actividades = $request->input('actividades');
        $proyectos->id_ayuda = $request->input('id_ayuda');
        $proyectos->fecha_inicial = Carbon::createFromFormat('d/m/Y', $fechaInicialInput)->format('Y-m-d');
        $proyectos->fecha_final = Carbon::createFromFormat('d/m/Y', $fechaFinalInput)->format('Y-m-d');
        $proyectos->prioridad = $request->input('prioridad');


        if ($request->hasFile('acta_conformidad')) {
        $rutaGuardarDocs = 'acta_conformidad/proyectos/';
        $nombresActas = [];

        foreach ($request->file('acta_conformidad') as $acta_conformidad) {
            $nombreActa = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($acta_conformidad->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $acta_conformidad->getClientOriginalExtension();
            $acta_conformidad->move(public_path($rutaGuardarDocs), $nombreActa);
            $nombresActas[] = $nombreActa;
        }

            $proyectos->acta_conformidad = json_encode($nombresActas);
        }

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
        //
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
        $ayudas = Ayudas::all();
        $acta_conformidad = $proyecto->acta_conformidad;
        return view('proyecto.edit', compact('proyecto', 'ayudas', 'acta_conformidad'));
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
            $proyecto->tipo_pro= $request->input('tipo_pro');
            // $proyecto->actividades = $request->input('actividades');
            $proyecto->fecha_inicial = Carbon::createFromFormat('d/m/Y', $fechaInicialInput)->format('Y-m-d');
            $proyecto->fecha_final = Carbon::createFromFormat('d/m/Y', $fechaFinalInput)->format('Y-m-d');
            $proyecto->prioridad = $request->input('prioridad');

             // Verificar si se han cargado nuevos archivos
            if ($request->hasFile('acta_conformidad')) {
                $rutaGuardarImg = 'acta_conformidad/proyectos/';
                $nombresActas = [];

                foreach ($request->file('acta_conformidad') as $acta_conformidad) {
                    $nombreActa = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($acta_conformidad->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $acta_conformidad->getClientOriginalExtension();
                    $acta_conformidad->move(public_path($rutaGuardarImg), $nombreActa);
                    $nombresActas[] = $nombreActa;
                }

                // Actualizar las imágenes
                $proyecto->acta_conformidad = json_encode($nombresActas);
            }

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
        try {
            $proyecto = Proyectos::findOrFail($id);
        
            $proyecto->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('proyecto')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el proyecto debido a que está asociado a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}

    