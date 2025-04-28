<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunas;
use App\Models\Parroquia;
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
            'cedula_comunas.unique' => 'Está cedula Ya Existe.',
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
            ],
            [
            'cedula_comunas.unique' => 'Está cedula Ya Existe.'
            ]
        );

        // Obtener La Comuna por ID
        $comuna =  Comunas::find($id);
        $parroquias = Parroquia::all();

        // Actualizar los campos segun los del formulario
        $comuna->cedula_comunas = $request->input('cedula_comunas');
        $comuna->nombre_comunas = $request->input('nombre_comunas');
        $comuna->apellido_comunas = $request->input('apellido_comunas');
        $comuna->telefono = $request->input('telefono');
        $comuna->nom_comunas = $request->input('nom_comunas');
        $comuna->id_parroquia = $request->input('id_parroquia');
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
