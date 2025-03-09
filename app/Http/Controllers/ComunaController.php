<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunas;
use App\Models\Parroquia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comunas::all();
        return view('comuna.index', compact('comunas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parroquias = Parroquia::all();
        return view('comuna.create', compact('parroquias'));
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
            'cedula_comunas' => 'required|unique:comunas,cedula_comunas'
            ],
            [
            'cedula_comunas.unique' => 'Está cedula ya existe.',
            ]
        );

        $comunas = new Comunas();
        $comunas->cedula_comunas = $request->input('cedula_comunas');
        $comunas->nombre_comunas = $request->input('nombre_comunas');
        $comunas->apellido_comunas = $request->input('apellido_comunas');
        $comunas->telefono = $request->input('telefono');
        $comunas->nom_comunas = $request->input('nom_comunas');
        $comunas->id_parroquia = $request->input('id_parroquia');
        $comunas->dire_comunas = $request->input('dire_comunas');

        $comunas->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

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
        return view('comuna.edit',compact('comuna','parroquias'));
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
            'cedula_comunas' => 'required|unique:comunas,cedula_comunas,' . $id,
            // 'nom_comunas' => 'required|unique:comunas,nom_comunas ' . $id,
            ],
            [
            'cedula_comunas.unique' => 'Está cedula ya existe.'
            // 'nom_comunas.unique' => 'El nombre de este comuna ya existe.'
            ]
        );

        $comuna =  Comunas::find($id);
        $parroquias = Parroquia::all();

        $comuna->cedula_comunas = $request->input('cedula_comunas');
        $comuna->nombre_comunas = $request->input('nombre_comunas');
        $comuna->apellido_comunas = $request->input('apellido_comunas');
        $comuna->nom_comunas = $request->input('nom_comunas');
        $comuna->id_parroquia = $request->input('id_parroquia');
        $comuna->dire_comunas = $request->input('dire_comunas');

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
