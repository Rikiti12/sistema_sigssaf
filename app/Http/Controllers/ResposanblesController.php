<?php

namespace App\Http\Controllers;

use App\Models\Resposanbles;
use App\Models\Cargos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ResposanblesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resposanbles = Resposanbles::with('cargo')->get();
        return view('resposanble.index', compact('resposanbles'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $resposanbles = Resposanbles::where('cedula', 'LIKE', '%' . $search . '%')
                           ->orWhere('nombre', 'LIKE', '%' . $search . '%')
                           ->orWhere('apellido', 'LIKE', '%' . $search . '%')
                           ->orWhereHas('cargo', function ($query) use ($search){
                            $query->where('nombre_cargo', 'LIKE', '%' . $search . '%');
                           })
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $resposanbles = Resposanbles::all();
             $resposanbles =Resposanbles::with('cargo')->get();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('resposanble.pdf', compact('resposanbles'));
        return $pdf->stream('resposanble.pdf');
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resposanbles = Resposanbles::all();
        $cargos = Cargos::all();
        return view('resposanble.create' , compact('cargos'));;
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
            'cedula' => 'required|unique:voceros,cedula',
            'nombre' => 'required',
            'apellido' => 'required',
        ], [
            'cedula.unique' => 'Este cedula ya existe.',
        ]);

        $resposanbles = new Resposanbles();
        $resposanbles->cedula = $request->input('cedula');
        $resposanbles->nombre = $request->input('nombre');
        $resposanbles->apellido = $request->input('apellido');
        $resposanbles->id_cargo = $request->input('id_cargo');

        $resposanbles->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('resposanble.index')->with('success', '✅ El responsable ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resposanbles  $resposanbles
     * @return \Illuminate\Http\Response
     */
    public function show(Resposanbles $resposanbles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resposanbles  $resposanbles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resposanbles = Resposanbles::find($id);
        $cargos = Cargos::all();
        return view('resposanble.edit', compact('resposanbles','cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resposanbles  $resposanbles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // $request->validate([
       // 'cedula' => 'required|unique:cedula',
          //  'nombre' => 'required',
            //'apellido' => 'required',
            

        $resposanble = Resposanbles::find($id);
        $resposanble->cedula = $request->input('cedula');
        $resposanble->nombre = $request->input('nombre');
        $resposanble->apellido = $request->input('apellido');
         $resposanble->id_cargo = $request->input('id_cargo');
    
        $resposanble->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('resposanble')->with('success', '✅ El responsable ha sido Actualizado exitosamente.');
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
       Resposanbles::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('resposanble.index')->with('eliminar', 'ok');
    }
}
