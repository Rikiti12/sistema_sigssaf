<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denunciantes;
use App\Models\Municipio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class DenuncianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $denunciantes = Denunciantes::all();
        return view('denunciante.index', compact('denunciantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = Municipio::all();
        return view('denunciante.create', compact('municipios'));
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
            'cedula' => 'required|unique:denunciantes,cedula',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'id_municipio' => 'required',
            'direccion' => 'required'
            ],
            [
            'cedula.unique' => 'Está cedula ya existe.'
            ]
        );

        $denunciante = new Denunciantes();
        $denunciante->cedula = $request->input('cedula');
        $denunciante->nombre = $request->input('nombre');
        $denunciante->apellido = $request->input('apellido');
        $denunciante->telefono = $request->input('telefono');
        $denunciante->id_municipio = $request->input('id_municipio');
        $denunciante->direccion = $request->input('direccion');

        $denunciante->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
        
            return redirect()->route('denunciante.index');

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
        $denunciante =  Denunciantes::find($id);
        $municipios = Municipio::all();
        return view('denunciante.edit',compact('denunciante','municipios'));
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
            'cedula' => 'required|unique:denunciantes,cedula,' . $id,
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'id_municipio' => 'required',
            'direccion' => 'required'
            ],
            [
            'cedula.unique' => 'Está cedula ya existe.'
            ]
        );

        $denunciante =  Denunciantes::find($id);
        $municipios = Municipio::all();

        $denunciante->cedula = $request->input('cedula');
        $denunciante->nombre = $request->input('nombre');
        $denunciante->apellido = $request->input('apellido');
        $denunciante->telefono = $request->input('telefono');
        $denunciante->id_municipio = $request->input('id_municipio');
        $denunciante->direccion = $request->input('direccion');

        $denunciante->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('denunciante');
    
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
        Denunciantes::find($id)->delete();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect()->route('denunciante.index')->with('eliminar', 'ok');
    }
}
