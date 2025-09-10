<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunas;
use App\Models\Parroquia;
use App\Models\ConsejoComunal;
use App\Models\Voceros;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;


class ComunaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-comuna|crear-comuna|editar-comuna|borrar-comuna', ['only' => ['index']]);
         $this->middleware('permission:crear-comuna', ['only' => ['create','store']]);
         $this->middleware('permission:editar-comuna', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-comuna', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comunas::with('consejo_comunals')->get();
        $comunas = Comunas::with('vocero')->get();
        return view('comuna.index', compact( 'comunas'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $comunas = Comunas::where('nom_comunas', 'LIKE', '%' . $search . '%')
                           ->orWhereHas('parroquia', function ($query) use ($search){
                            $query->where('nom_parroquia', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhereHas('consejo_comunal', function ($query) use ($search){
                            $query->where('nom_consej', 'LIKE', '%' . $search . '%')
                            ->orWhere('rif', 'LIKE', '%' . $search . '%')
                            ->orWhere('situr', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhereHas('vocero', function ($query) use ($search){
                            $query->where('cedula', 'LIKE', '%' . $search . '%')
                            ->orWhere('nombre', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellido', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhere('dire_comunas', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $comunas = Comunas::with('parroquia')->get();
            $comunas = Comunas::with('consejo_comunals')->get();
            $comunas = Comunas::with('vocero')->get();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('comuna.pdf', compact('comunas'));
        return $pdf->stream('comuna.pdf');
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parroquias = Parroquia::all();
        $consejo_comunals = ConsejoComunal::all();
        $voceros = Voceros::all();
        return view('comuna.create', compact('parroquias', 'consejo_comunals', 'voceros'));
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
        //     'cedula_comunas' => 'required|unique:comunas,cedula_comunas'
        //     ],
        //     [
        //     'cedula_comunas.unique' => 'Está cedula Ya Existe.',
        //     ]
        // );

        $comunas = new Comunas();
        $comunas->nom_comunas = $request->input('nom_comunas');
        $comunas->id_parroquia = $request->input('id_parroquia');
        $comunas->id_consejo = $request->input('id_consejo');
        $comunas->id_vocero = $request->input('id_vocero');
        $comunas->dire_comunas = $request->input('dire_comunas');

        $comunas->save();

        //$bitacora = new BitacoraController();
        //$bitacora->update();

        try {
        
            return redirect()->route('comuna.index');

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
        $comuna =  Comunas::find($id);
        $parroquias = Parroquia::all();
        $consejo_comunals = ConsejoComunal::all();
         $voceros = Voceros::all();
        return view('comuna.edit',compact('comuna','parroquias', 'consejo_comunals','voceros'));
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
        //     'cedula_comunas' => 'required|unique:comunas,cedula_comunas,' . $id,
        //     ],
        //     [
        //     'cedula_comunas.unique' => 'Está cedula Ya Existe.'
        //     ]
        // );

        // Obtener La Comuna por ID
        $comuna =  Comunas::find($id);
        $parroquias = Parroquia::all();
        $consejo_comunals = ConsejoComunal::all();
        $voceros = Voceros::all();

        // Actualizar los campos segun los del formulario
        $comuna->nom_comunas = $request->input('nom_comunas');
        $comuna->id_parroquia = $request->input('id_parroquia');
        $comuna->id_consejo = $request->input('id_consejo');
        $comuna->id_vocero = $request->input('id_vocero');
        $comuna->dire_comunas = $request->input('dire_comunas');

        // Guardar los cambios en la base de datos
        $comuna->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('comuna');
    
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
        Comunas::find($id)->delete();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect()->route('comuna.index')->with('eliminar', 'ok');
    }
}
