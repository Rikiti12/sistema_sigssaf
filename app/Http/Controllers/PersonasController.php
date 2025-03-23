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

    public function getPersonaDetalles($id)
    {
        // Recupera la persona por su ID
        $persona = Personas::find($id);

        if (!$persona) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'correo' => $persona->correo,
            'discapacidad' => $persona->discapacidad,
            'embarazada' =>$persona->embarazada,
            'jefe_familia' =>$persona->jefe_familia,
            'genero' =>$persona->genero,

        ]);

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
        // $request->validate([
        //     'correo' => 'required|cedula|unique:personas,cedula',
        //     'nombre' => 'required',
        //     'apellido' => 'required',
        //     'fecha_nacimiento' => 'required|date',
        //     'genero' => 'required',
        //     'telefono' => 'required',
        //     'correo' => 'required|email|unique:personas,correo',
        //     'direccion' => 'required',
        //     'discapacidad' => 'required|boolean',
        //     'embarazada' => 'required|boolean',
        //     'jefe_familia' => 'required|boolean',
        // ], [
        //     'correo.unique' => 'Este cedula ya existe.',
        //     'correo.unique' => 'Este correo ya existe.'
        // ]);

        $personas = new Personas();
        $personas->cedula = $request->input('cedula');
        $personas->nombre = $request->input('nombre');
        $personas->apellido = $request->input('apellido');
        $personas->fecha_nacimiento = $request->input('fecha_nacimiento');
        $personas->edad = $request->input('edad');
        $personas->genero = $request->input('genero');
        $personas->telefono = $request->input('telefono');
        $personas->correo = $request->input('correo');
        $personas->direccion = $request->input('direccion');
        $personas->discapacidad = $request->input('discapacidad');
        $personas->embarazada = $request->input('embarazada');
        $personas->jefe_familia = $request->input('jefe_familia');

        $personas->save();

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
