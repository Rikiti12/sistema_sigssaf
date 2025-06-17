<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsejoComunal;
use App\Models\Voceros;
use App\Models\Comunidades;
use App\Http\Controllers\BitacoraController;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class ConsejoComunalController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-consejocomunal|crear-consejocomunal|editar-consejocomunal|borrar-consejocomunal', ['only' => ['index']]);
        $this->middleware('permission:crear-consejocomunal', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-consejocomunal', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-consejocomunal', ['only' => ['destroy']]);
    }

    public function index()
    {
        $consejo_comunals = ConsejoComunal::with('vocero')->get();
        $consejo_comunals = ConsejoComunal::with('comunidad')->get();
        return view('consejo_comunal.index', compact('consejo_comunals'));
    }

     public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $consejo_comunals = ConsejoComunal::where('nom_consej', 'LIKE', '%' . $search . '%')
                           ->orWhere('codigo_situr', 'LIKE', '%' . $search . '%')
                           ->orWhere('rif', 'LIKE', '%' . $search . '%')
                           ->orWhere('dire_consejo', 'LIKE', '%' . $search . '%')
                           ->orWhereHas('vocero', function ($query) use ($search){
                            $query->where('cedula', 'LIKE', '%' . $search . '%')
                            ->orWhere('nombre', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('apellido', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhereHas('comunidad', function ($query) use ($search){
                            $query->where('nom_comuni', 'LIKE', '%' . $search . '%');
                           })
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $consejo_comunals = ConsejoComunal::with('vocero')->get();
            $consejo_comunals = ConsejoComunal::with('comunidad')->get();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('consejo_comunal.pdf', compact('consejo_comunals'));
        return $pdf->stream('consejo_comunal.pdf');
    } 

    public function getconsejocomunalDetalles($id)
    {
        // Recupera el Proyecto por su ID
        $consejocomunal = ConsejoComunal::find($id);

        if (!$consejocomunal) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'situr' => $consejocomunal->situr,
            'rif' => $consejocomunal->rif,
            'acta' => $consejocomunal->acta,
            // 'dire_consejo' => $consejocomunal->dire_consejo,
            // 'id_comunidad' => $consejocomunal->comunidad->nom_comuni,
            
        ]);
 
    }

    public function create()
    {
        $voceros = Voceros::all();
        $comunidades = Comunidades::all();
        return view('consejo_comunal.create', compact('voceros', 'comunidades'));
    }

    public function store(Request $request)
    {
        /* $request->validate([
            'cedula_voce' => 'required|unique:consejo_comunals,cedula_voce',
        ], [
            'cedula_voce.unique' => 'Esta cédula ya existe.',
        ]); */

        $consejo_comunal = new ConsejoComunal();
        $consejo_comunal->nom_consej = $request->input('nom_consej');
        $consejo_comunal->situr = $request->input('situr');
        $consejo_comunal->rif = $request->input('rif');
        $consejo_comunal->acta = $request->input('acta');
        $consejo_comunal->dire_consejo = $request->input('dire_consejo');
        $consejo_comunal->id_vocero = $request->input('id_vocero');
        $consejo_comunal->id_comunidad = $request->input('id_comunidad');

        $consejo_comunal->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('consejo_comunal.index');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function edit($id)
    {
        $consejo_comunal = ConsejoComunal::find($id);
        $voceros = Voceros::all();
        $comunidades = Comunidades::all();
        return view('consejo_comunal.edit', compact('consejo_comunal', 'voceros', 'comunidades'));
    }

    public function update(Request $request, $id)
    {
        $consejo_comunal = ConsejoComunal::find($id);

        $consejo_comunal->nom_consej = $request->input('nom_consej');
        $consejo_comunal->situr = $request->input('situr');
        $consejo_comunal->rif = $request->input('rif');
        $consejo_comunal->acta = $request->input('acta');
        $consejo_comunal->dire_consejo = $request->input('dire_consejo');
        $consejo_comunal->id_vocero = $request->input('id_vocero');
        $consejo_comunal->id_comunidad = $request->input('id_comunidad');

        $consejo_comunal->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect ('consejo_comunal');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function destroy($id)
    {
        ConsejoComunal::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('consejo_comunal.index')->with('eliminar', 'ok');
    }
}