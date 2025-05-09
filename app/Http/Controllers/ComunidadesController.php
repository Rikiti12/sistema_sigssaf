<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunidades;
use App\Models\Comunas;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ComunidadesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-comunidad|crear-comunidad|editar-comunidad|borrar-comunidad', ['only' => ['index']]);
         $this->middleware('permission:crear-comunidad', ['only' => ['create','store']]);
         $this->middleware('permission:editar-comunidad', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-comunidad', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $comunidades = Comunidades::with('comuna')->get(); // Cargar la relación con tabla "conmuas"
        return view('comunidad.index', compact('comunidades'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $comunidades = Comunidades::where('cedula_jefe', 'LIKE', '%' . $search . '%')
                           ->orWhere('nom_jefe', 'LIKE', '%' . $search . '%')
                           ->orWhere('ape_jefe', 'LIKE', '%' . $search . '%')
                           ->orWhere('telefono', 'LIKE', '%' . $search . '%')
                           ->orWhere('nom_comuni', 'LIKE', '%' . $search . '%')
                           ->orWhereHas('comuna', function ($query) use ($search){
                            $query->where('nom_comunas', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhere('dire_comuni', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $comunidades = Comunidades::with('comuna')->get();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('comunidad.pdf', compact('comunidades'));
        return $pdf->stream('comunidad.pdf');
    } 

    public function getComunidadDetalles($id)
    {
        // Recupera el Proyecto por su ID
        $comunidad = Comunidades::find($id);

        if (!$comunidad) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Comunidad no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'crear_pro' => $comunidad->crear_pro,
            'nom_proyecto' => $comunidad->nom_proyecto,
            'descripcion' => $comunidad->descripcion,
            
        ]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comunas = Comunas::all(); // Obtener todos los registros de la tabla "comunas"
        return view('comunidad.create', compact('comunas'));
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
            'cedula_jefe' => 'required|unique:comunidades,cedula_jefe'
            ],
            [
            'cedula_jefe.unique' => 'Está cedula ya existe.',
            ]);
        

        $comunidades = new Comunidades();
        $comunidades->cedula_jefe = $request->input('cedula_jefe');
        $comunidades->nom_jefe = $request->input('nom_jefe');
        $comunidades->ape_jefe = $request->input('ape_jefe');
        $comunidades->telefono = $request->input('telefono');
        $comunidades->nom_comuni = $request->input('nom_comuni');
        $comunidades->dire_comuni = $request->input('dire_comuni');
        $comunidades->id_comuna = $request->input('id_comuna');
        $comunidades->crear_pro = $request->input('crear_pro');
        $comunidades->nom_proyecto = $request->input('nom_proyecto');
        $comunidades->descripcion = $request->input('descripcion');

        $comunidades->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
        
            return redirect()->route('comunidad.index');

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
        $comunidad = Comunidades::find($id);
        $comunas =  Comunas::all();
        return view('comunidad.edit',compact('comunidad','comunas'));
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
        //     'cedula_jefe_comunidades' => 'required|unique:comunidades,cedula_jefe_comunidades,' . $id,
        //     ],
        //     [
        //     'cedula_jefe_comunidades.unique' => 'Está cedula ya existe.'
        //     ]
        // );

        $comunidad = Comunidades::find($id);
        $comuna = Comunas::all();
       
        $comunidad->cedula_jefe = $request->input('cedula_jefe');
        $comunidad->nom_jefe = $request->input('nom_jefe');
        $comunidad->ape_jefe = $request->input('ape_jefe');
        $comunidad->telefono = $request->input('telefono');
        $comunidad->nom_comuni = $request->input('nom_comuni');
        $comunidad->dire_comuni = $request->input('dire_comuni');
        $comunidad->id_comuna = $request->input('id_comuna');
        $comunidad->crear_pro = $request->input('crear_pro');
        $comunidad->nom_proyecto = $request->input('nom_proyecto');
        $comunidad->descripcion = $request->input('descripcion');

        $comunidad->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('comunidad');
    
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
        Comunidades::find($id)->delete();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect()->route('comunidad.index')->with('eliminar', 'ok');
    }
}