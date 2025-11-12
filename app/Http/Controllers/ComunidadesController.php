<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunidades;
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
        $comunidades = Comunidades::all();
        return view('comunidad.index', compact('comunidades'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $comunidades = Comunidades::where('nom_comuni', 'LIKE', '%' . $search . '%')
                           ->orWhere('dire_comuni', 'LIKE', '%' . $search . '%')
                            ->orWhere('tipo_comunidad', 'LIKE', '%' . $search . '%')
                            ->orWhere('tipo_vivienda', 'LIKE', '%' . $search . '%')
                            ->orWhere('lindero_norte', 'LIKE', '%' . $search . '%')
                           ->orWhere('lindero_sur', 'LIKE', '%' . $search . '%')
                           ->orWhere('lindero_este', 'LIKE', '%' . $search . '%')
                           ->orWhere('lindero_oeste', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $comunidades = Comunidades::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('comunidad.pdf', compact('comunidades'));
        return $pdf->stream('comunidad.pdf');
    } 

    // Asumiendo que esta función va en tu ComunidadesController.php o similar

public function getComunidadDetalles($id)
{
    // 1. Recupera la comunidad por su ID.
    $comunidad = Comunidades::find($id);

    if (!$comunidad) {
        // Maneja el caso en que no se encuentre la comunidad
        return response()->json(['error' => 'Comunidad no encontrada'], 404);
    }

    // 2. Devuelve los datos relevantes en formato JSON, incluyendo los linderos.
    return response()->json([
        
        'lindero_norte' => $comunidad->lindero_norte, 
        'lindero_sur' => $comunidad->lindero_sur, 
        'lindero_este' => $comunidad->lindero_este, 
        'lindero_oeste' => $comunidad->lindero_oeste, 
      
        
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comunidad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $comunidades = new Comunidades();
        $comunidades->nom_comuni = $request->input('nom_comuni');
        $comunidades->dire_comuni = $request->input('dire_comuni');
        $comunidades->tipo_comunidad = $request->input('tipo_comunidad');
        $comunidades->tipo_vivienda = $request->input('tipo_vivienda');
        $comunidades->lindero_norte = $request->input('lindero_norte');
        $comunidades->lindero_sur = $request->input('lindero_sur');
        $comunidades->lindero_este = $request->input('lindero_este');
        $comunidades->lindero_oeste = $request->input('lindero_oeste');
        

        $comunidades->save();

        //$bitacora = new BitacoraController();
       // $bitacora->update();

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
        return view('comunidad.edit',compact('comunidad'));
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
    
        $comunidad->nom_comuni = $request->input('nom_comuni');
        $comunidad->dire_comuni = $request->input('dire_comuni');
        $comunidad->nom_comuni = $request->input('tipo_comunidad');
        $comunidad->dire_comuni = $request->input('tipo_vivienda');
        $comunidad->lindero_norte = $request->input('lindero_norte');
        $comunidad->lindero_sur = $request->input('lindero_sur');
        $comunidad->lindero_este = $request->input('lindero_este');
        $comunidad->lindero_oeste = $request->input('lindero_oeste');
      
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