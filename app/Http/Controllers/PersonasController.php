<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class PersonasController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Personas::all();
        return view('persona.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Personas::all();
        return view('persona.create');
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
            'cedula' => 'required|unique:personas,cedula',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique:personas,correo',
            'direccion' => 'required',
            'discapacidad' => 'required|boolean',
            'embarazada' => 'required|boolean',
            'jefe_familia' => 'required|boolean',
        ], [
            'correo.unique' => 'Este correo ya existe.',
            'cedula.unique' => 'Este cedula ya existe.',
        ]);

        $persona = new Personas();
        $persona->cedula = $request->input('cedula');
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->edad = $request->input('edad');
        $persona->genero = $request->input('genero');
        $persona->telefono = $request->input('telefono');
        $persona->correo = $request->input('correo');
        $persona->direccion = $request->input('direccion');
        $persona->discapacidad = $request->input('discapacidad');
        $persona->embarazada = $request->input('embarazada');
        $persona->jefe_familia = $request->input('jefe_familia');

        $persona->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('persona.index');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
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
        $persona = Personas::find($id);
        return view('persona.edit', compact('persona'));
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
       // 'cedula' => 'required|unique:cedula',
          //  'nombre' => 'required',
            //'apellido' => 'required',
            //'fecha_nacimiento' => 'required|date',
            //'genero' => 'required',
            //'telefono' => 'required',
            //'correo' => 'required|email|unique:personas,correo,' . $id,
            //'direccion' => 'required',
            //'discapacidad' => 'required|boolean',
            //'embarazada' => 'required|boolean',
            //'jefe_familia' => 'required|boolean',
        //], [
            //'correo.unique' => 'Este correo ya existe.',
        //]);

        $persona = Personas::find($id);
        $persona->cedula = $request->input('cedula');
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->edad = $request->input('edad');
        $persona->genero = $request->input('genero');
        $persona->telefono = $request->input('telefono');
        $persona->correo = $request->input('correo');
        $persona->direccion = $request->input('direccion');
        $persona->discapacidad = $request->input('discapacidad');
        $persona->embarazada = $request->input('embarazada');
        $persona->jefe_familia = $request->input('jefe_familia');

        $persona->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('persona');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
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
        Personas::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('persona.index')->with('eliminar', 'ok');
    }
}
