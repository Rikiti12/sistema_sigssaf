<?php

namespace App\Http\Controllers;
use App\Models\Visitas;
use App\Models\Parroquia;
use App\Models\Comunidades;
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
        $visitas = Visitas::with('parroquia')->get();
        $visitas = Visitas::with('comunidad')->get();
        return view('visita.index', compact('visitas'));
    }

     public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $visitas = Visitas::where('id_parroquia', 'LIKE', '%' . $search . '%')
                         ->orWhere('id_comunidad', 'LIKE', '%' . $search . '%')
                           ->orWhere('visita', 'LIKE', '%' . $search . '%')
                           ->orWhere('descripcion_vis', 'LIKE', '%' . $search . '%')
                           ->orWhere('evidencia', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $visitas =Visitas::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('visita.pdf', compact('visitas'));
        return $pdf->stream('visita.pdf');
    }
    
    /* public function getvisitaDetalles($id)
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
 
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parroquias = Parroquia::all();
        $comunidades = Comunidades::all();
        return view('visita.create', compact('parroquias','comunidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request, [
            'evidencia' => 'required|array|min:1',
            'evidencia.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'evidencia.required' => 'Debe registrar una o más fotos.',
            'evidencia.min' => 'Debe registrar al menos una foto.',
            'evidencia.*.image' => 'Cada archivo debe ser una imagen.',
            'evidencia.*.mimes' => 'Las imágenes deben ser de tipo jpeg, png, jpg, gif o svg.',
        ]);
       
        $visitas = new Visitas();
        $visitas->id_parroquia = $request->input('id_parroquia');
        $visitas->id_comunidad = $request->input('id_comunidad');
        $visitas->visita = $request->input('visita');
        $visitas->descripcion_vis = $request->input('descripcion_vis');

        if ($request->hasFile('evidencia')) {
            $rutaGuardarDocs = 'evidencia/visitas/';
            $nombresVisitas = [];
    
            foreach ($request->file('evidencia') as $evidencia) {
                $nombreVisita = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($evidencia->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $evidencia->getClientOriginalExtension();
                $evidencia->move(public_path($rutaGuardarDocs), $nombreVisita);
                $nombresVisitas[] = $nombreVisita;
            }
    
                $visitas->evidencia = json_encode($nombresVisitas);
            }
      
        $visitas->save();

        // Registrar en bitácora
        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('visita.index')->with('success', '✅ El visita ha sido Guardada exitosamente.');
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
        $parroquias = Parroquia::all();
        $comunidades = Comunidades::all();
        $evidencia = $visita->evidencia;
        return view('visita.edit', compact('visita', 'parroquias', 'comunidades','evidencia'));
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
                // 'nombre_pro' => 'required|string|max:150',
                // 'descripcion_pro' => 'nullable|string',
               /*  'tipo_pro' => 'required|in:Infraestructura,Social,Educativo,Salud,Ambiental,Otro',
                'fecha_inicial' => 'required|date_format:d/m/Y',
                'fecha_final' => 'required|date_format:d/m/Y|after_or_equal:fecha_inicial',
                'prioridad' => 'required|in:Alta,Media,Baja',
                 */
            ]);

            $visita = Visitas::find($id);
            $visita->id_parroquia = $request->input('id_parroquia');
            $visita->id_comunidad = $request->input('id_comunidad');
            $visita->visita = $request->input('visita');
            $visita->descripcion_vis = $request->input('descripcion_vis');

             // Verificar si se han cargado nuevos archivos
         if ($request->hasFile('evidencia')) {
            $rutaGuardarImg = 'evidencia/visitas/';
            $nombresVisitas = [];

            foreach ($request->file('evidencia') as $evidencia) {
                $nombreVisita = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($evidencia->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $evidencia->getClientOriginalExtension();
                $evidencia->move(public_path($rutaGuardarImg), $nombreVisita);
                $nombresVisitas[] = $nombreVisita;
            }

            // Actualizar las imágenes
            $visita->evidencia = json_encode($nombresVisitas);
        }

            $visita->save();
        
            // Registrar en bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();
        

        try {
            return redirect('visita')->with('success', '✅ El visita ha sido Actualizado exitosamente.');
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
             Visitas::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('visita.index')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el visita debido a que está asociado a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}

    