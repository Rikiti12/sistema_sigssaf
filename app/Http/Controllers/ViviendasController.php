<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Viviendas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ViviendasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-vivienda|crear-vivienda|editar-vivienda|borrar-vivienda', ['only' => ['index']]);
        $this->middleware('permission:crear-vivienda', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-vivienda', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-vivienda', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viviendas = Viviendas::all();
        return view('vivienda.index', compact('viviendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vivienda.create');
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
        //     'dire_vivie' => 'required',
        //     'tipo_vivie' => 'required',
        //     'id_persona' => 'required',
        // ]);

        $viviendas = new Viviendas();
        $viviendas->dire_vivie = $request->input('dire_vivie');
        $viviendas->tipo_vivie = $request->input('tipo_vivie');

        $viviendas->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('vivienda.index');
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
        $vivienda = Viviendas::find($id);
        return view('vivienda.edit', compact('vivienda'));
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
        //     'dire_vivie' => 'required',
        //     'tipo_vivie' => 'required',
        //     'id_persona' => 'required',
        // ]);

        $vivienda = Viviendas::find($id);

        $vivienda->dire_vivie = $request->input('dire_vivie');
        $vivienda->tipo_vivie = $request->input('tipo_vivie');

        $vivienda->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
            return redirect('vivienda');
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
        Viviendas::find($id)->delete();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect()->route('vivienda.index')->with('eliminar', 'ok');
    }
}