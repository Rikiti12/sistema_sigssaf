<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsejoComunal;
use App\Models\Comunidades;
use App\Http\Controllers\BitacoraController;
use Illuminate\Database\QueryException;

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
        $consejo_comunals = ConsejoComunal::with('comunidad')->get();
        return view('consejocomunal.index', compact('consejo_comunals'));
    }

    public function create()
    {
        $comunidades = Comunidades::all();
        return view('consejocomunal.create', compact('comunidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cedula_voce' => 'required|unique:consejo_comunals,cedula_voce',
        ], [
            'cedula_voce.unique' => 'Esta cédula ya existe.',
        ]);

        $consejo_comunal = new ConsejoComunal();
        $consejo_comunal->cedula_voce = $request->input('cedula_voce');
        $consejo_comunal->nom_voce = $request->input('nom_voce');
        $consejo_comunal->ape_voce = $request->input('ape_voce');
        $consejo_comunal->telefono = $request->input('telefono');
        $consejo_comunal->codigo_situr = $request->input('codigo_situr');
        $consejo_comunal->rif = $request->input('rif');
        $consejo_comunal->acta = $request->input('acta');
        $consejo_comunal->dire_consejo = $request->input('dire_consejo');
        $consejo_comunal->id_comunidad = $request->input('id_comunidad');

        $consejo_comunal->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('consejocomunal.index');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function edit($id)
    {
        $consejo_comunal = ConsejoComunal::find($id);
        $comunidades = Comunidades::all();
        return view('consejocomunal.edit', compact('consejo_comunal', 'comunidades'));
    }

    public function update(Request $request, $id)
    {
        $consejo_comunal = ConsejoComunal::find($id);

        $consejo_comunal->cedula_voce = $request->input('cedula_voce');
        $consejo_comunal->nom_voce = $request->input('nom_voce');
        $consejo_comunal->ape_voce = $request->input('ape_voce');
        $consejo_comunal->telefono = $request->input('telefono');
        $consejo_comunal->codigo_situr = $request->input('codigo_situr');
        $consejo_comunal->rif = $request->input('rif');
        $consejo_comunal->acta = $request->input('acta');
        $consejo_comunal->dire_consejo = $request->input('dire_consejo');
        $consejo_comunal->id_comunidad = $request->input('id_comunidad');

        $consejo_comunal->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('consejocomunal');
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
        return redirect()->route('consejocomunal.index')->with('eliminar', 'ok');
    }
}