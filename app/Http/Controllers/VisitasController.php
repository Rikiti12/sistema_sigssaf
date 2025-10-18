<?php

namespace App\Http\Controllers;
use App\Models\Visitas;
use App\Models\Resposanbles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitasController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-visita|crear-visita|editar-visita|borrar-visita', ['only' => ['index']]);
         $this->middleware('permission:crear-visita', ['only' => ['create','store']]);
         $this->middleware('permission:editar-visita', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-visita', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitas =Visitas::all();
        return view('visita.index', compact('visitas'));
    }

     public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $proyectos = Proyectos::where('visita', 'LIKE', '%' . $search . '%')
                           ->orWhere('descripcion_vis', 'LIKE', '%' . $search . '%')
                           ->orWhere('fecha_visita', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $visitas =Visitas::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('visita.pdf', compact('visitas'));
        return $pdf->stream('visita.pdf');
    }
    
    public function getvisitaDetalles($id)
    {
        // Recupera el visita por su ID
        $visita = visitas::find($id);

        if (!$visita) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'foto_visita' => $visita->foto_visita,
            
        ]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resposanbles = Resposanbles::all();
        return view('visita.create', compact('resposanbles'));
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
            'fecha_visita' => trim($request->input('fecha_visita')),
           
        ]);

        // Formateamos la fecha de hoy para usarla en las reglas 'after_or_equal' y 'before_or_equal'
        // $todayFormatted = Carbon::today()->format('d/m/Y');

        // 2. Realizar la validación directamente en el controlador.
        // El método validate() lanzará una excepción y redirigirá si falla.
        $this->validate($request, [
            'fecha_visita' => [
                'required',
                'date_format:d/m/Y', // Formato estricto DD/MM/YYYY
                'after_or_equal:' . $todayFormatted, // Debe ser hoy o después
                'before_or_equal:' . $todayFormatted, // Debe ser hoy o antes
                // Con estas dos reglas, fecha_visita DEBE ser exactamente la fecha de hoy.
            ],
            
                function ($attribute, $value, $fail) use ($request) {
                    try {
                        // Carbon::createFromFormat necesita el formato exacto.
                        // Gracias al trim() y date_format previo, esto debería ser seguro.
                        $fecha_visita = Carbon::createFromFormat('d/m/Y', $request->input('fecha_visita'));

                    } catch (\Exception $e) {
                        // Este catch es una capa de seguridad. Si el error "Trailing data" aún ocurre aquí,
                        // significa que el input no pasó la validación date_format correctamente o hay algo más.
                        $fail('Error interno al procesar las fechas. Asegúrate de que el formato sea DD/MM/YYYY y no contenga caracteres extraños.');
                        return;
                    }

                    // Calcular la fecha máxima permitida (7 días hábiles después de fecha_inicial)
                    $maxAllowedDate = $fecha_visita->copy();
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
                    
        
                },
            ],
        // Mensajes personalizados para la validación
        [
            'fecha_visita.required' => 'La fecha_visita es obligatoria.',
            'fecha_visita.date_format' => 'La fecha_visita debe tener el formato DD/MM/YYYY.',
            'fecha_visita.after_or_equal' => 'La fecha_visita debe ser la fecha actual (hoy).',
            'fecha_visita.before_or_equal' => 'La fecha_visita debe ser la fecha actual (hoy).',
        ]);

        // Si la validación pasa, el código continúa aquí.
        // Accede a los datos del request directamente, ya que no estamos usando validated()
        // (el método validate() del controlador ya se encargó de la validación).
        $fecha_visitaInput = $request->input('fecha_visita');

        $visitas = new Visitas();
        $visitas->id_resposanble = $request->input('id_resposanble');
        $visitas->visita = $request->input('visita');
        $visitas->descripcion_vis = $request->input('descripcion_vis');
        
        $visitas->fecha_visita = Carbon::createFromFormat('d/m/Y', $fecha_visitaInput)->format('Y-m-d');
       

        if ($request->hasFile('foto_visita')) {
        $rutaGuardarDocs = 'foto_visita/visitas/';
        $nombresActas = [];

        foreach ($request->file('foto_visita') as $foto_visita) {
            $nombreActa = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto_visita->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto_visita->getClientOriginalExtension();
            $foto_visita->move(public_path($rutaGuardarDocs), $nombreActa);
            $nombresActas[] = $nombreActa;
        }

            $visitas->foto_visita = json_encode($foto_visita);
        }

        $visitas->save();

        // Registrar en bitácora
        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('visita.index');
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
        $visita = Visitas::find($id);
        $resposanbles = Resposanbles::all();
        $foto_visita = $visita->foto_visita;
        return view('visita.edit', compact('visita', 'resposanbles', 'foto_visita'));
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
                'fecha_inicial' => 'required|date_format:d/m/Y',
                'fecha_final' => 'required|date_format:d/m/Y|after_or_equal:fecha_inicial',
                'prioridad' => 'required|in:Alta,Media,Baja',
                
            ]);

            $visita = Visitas::find($id);
            $visita->id_resposanble = $request->input('id_resposanble');
            $visita->visita = $request->input('visita');
            $visita->descripcion_vis = $request->input('descripcion_vis');
            $visita->fecha_visita = Carbon::createFromFormat('d/m/Y', $request->input('fecha_visita'))->format('Y-m-d');

             // Verificar si se han cargado nuevos archivos
            if ($request->hasFile('foto_visita')) {
                $rutaGuardarImg = 'foto_visita/visitas/';
                $foto_visita = [];

                foreach ($request->file('foto_visita') as $foto_visita) {
                    $foto_visita = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto_visita->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto_visita->getClientOriginalExtension();
                    $foto_visita->move(public_path($rutaGuardarImg), $foto_visita);
                    $foto_visita[] = $foto_visita;
                }

                // Actualizar las imágenes
                $visita->foto_visita = json_encode($foto_visita);
            }

            $visita->save();
        
            // Registrar en bitácora
           $bitacora = new BitacoraController();
           $bitacora->update();
        

        try {
            return redirect('visita');
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
            $visita = Visitas::findOrFail($id);
        
            $visita->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('visita')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el visita debido a que está asociado a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}

    