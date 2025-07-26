<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voceros;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class VocerosController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voceros = Voceros::all();
        return view('vocero.index', compact('voceros'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $voceros = Voceros::where('cedula', 'LIKE', '%' . $search . '%')
                           ->orWhere('nombre', 'LIKE', '%' . $search . '%')
                           ->orWhere('apellido', 'LIKE', '%' . $search . '%')
                           ->orWhere('fecha_nacimiento', 'LIKE', '%' . $search . '%')
                           ->orWhere('edad', 'LIKE', '%' . $search . '%')
                           ->orWhere('genero', 'LIKE', '%' . $search . '%')
                           ->orWhere('telefono', 'LIKE', '%' . $search . '%')
                           ->orWhere('correo', 'LIKE', '%' . $search . '%')
                           ->orWhere('direccion', 'LIKE', '%' . $search . '%')
                           ->orWhere('cargo', 'LIKE', '%' . $search . '%')
                           ->orWhere('tipo', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $voceros = Voceros::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('vocero.pdf', compact('voceros'));
        return $pdf->stream('vocero.pdf');
    } 

    public function getVoceroDetalles($id)
    {
        // Recupera la persona por su ID
        $vocero = Voceros::find($id);

        if (!$vocero) {
            // Maneja el caso en que no se encuentre la persona
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'correo' => $vocero->correo,
            'genero' =>$vocero->genero,
            'cargo' =>$vocero->cargo,
            'tipo_vocero' =>$vocero->tipo_vocero,

        ]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voceros = Voceros::all();
        return view('vocero.create');
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
        //     'cedula' => 'required|unique:personas,cedula',
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
        //     'correo.unique' => 'Este correo ya existe.',
        //     'cedula.unique' => 'Este cedula ya existe.',
        // ]);

        $voceros = new Voceros();
        $voceros->cedula = $request->input('cedula');
        $voceros->nombre = $request->input('nombre');
        $voceros->apellido = $request->input('apellido');
        $voceros->fecha_nacimiento = $request->input('fecha_nacimiento');
        $voceros->edad = $request->input('edad');
        $voceros->genero = $request->input('genero');
        $voceros->telefono = $request->input('telefono');
        $voceros->correo = $request->input('correo');
        $voceros->direccion = $request->input('direccion');
        $voceros->cargo = $request->input('cargo');
        $voceros->tipo_vocero = $request->input('tipo_vocero');

        $voceros->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('vocero.index');
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
        $vocero = Voceros::find($id);
        return view('vocero.edit', compact('vocero'));
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

        $vocero = Voceros::find($id);
        $vocero->cedula = $request->input('cedula');
        $vocero->nombre = $request->input('nombre');
        $vocero->apellido = $request->input('apellido');
        $vocero->fecha_nacimiento = $request->input('fecha_nacimiento');
        $vocero->edad = $request->input('edad');
        $vocero->genero = $request->input('genero');
        $vocero->telefono = $request->input('telefono');
        $vocero->correo = $request->input('correo');
        $vocero->direccion = $request->input('direccion');
        $vocero->cargo = $request->input('cargo');
        $vocero->tipo_vocero = $request->input('tipo_vocero');
    
        $vocero->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('vocero');
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
        Voceros::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('vocero.index')->with('eliminar', 'ok');
    }
}
