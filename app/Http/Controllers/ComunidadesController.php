<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunidades;
use App\Models\Comunas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ComunidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $comunidades = Comunidades::with('comunas')->get(); // Cargar la relación con tabla "conmuas"
        return view('comunidad.index', compact('comunidades'));
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
            'cedula_jefe_comunidades.unique' => 'Está cedula ya existe.'
            ]
        );

        $comunidades = new Comunidades();
        $comunidades->cedula_jefe = $request->input('cedula_jefe');
        $comunidades->nom_jefe = $request->input('nom_jefe');
        $comunidades->ape_jefe = $request->input('ape_jefe');
        $comunidades->telefono = $request->input('telefono');
        $comunidades->nom_comuni = $request->input('nom_comuni');
        $comunidades->dire_comuni = $request->input('dire_comuni');
        $comunidades->id_comuna = $request->input('id_comuna');

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
        $victima =  Victimas::find($id);
        return view('victima.edit',compact('victima'));
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
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required',
          
       ]);

        $victima = Victimas::find($id);
       
        $victima->nombre = $request->input('nombre');
        $victima->apellido = $request->input('apellido');
        $victima->edad = $request->input('edad');

        $victima->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('victima');
    
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
        Victimas::find($id)->delete();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect()->route('victima.index')->with('eliminar', 'ok');
    }
}