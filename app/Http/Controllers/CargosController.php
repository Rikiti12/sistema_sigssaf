<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargos::all();
        return view('cargo.index', compact( 'cargos'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $cargos = Cargos::where('Nombre Cargo', 'LIKE', '%' . $search . '%')
                           ->orWhere('Categoria', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $cargos = Cargos::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('cargo.pdf', compact('cargos'));
        return $pdf->stream('cargo.pdf');
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargos::all();
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $cargos = new Cargos();
        $cargos->nombre_cargo = $request->input('nombre_cargo');
        $cargos->categoria = $request->input('categoria');

        $cargos->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('cargo.index')->with('success', '✅ El cargo ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show(Cargos $cargos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargos::find($id);
        return view('cargo.edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cargo = Cargos::find($id);
        $cargo->nombre_cargo = $request->input('nombre_cargo');
        $cargo->categoria = $request->input('categoria');

        $cargo->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('cargo')->with('success', '✅ El cargo ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargos  $cargos
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
       Cargos::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('cargo.index')->with('eliminar', 'ok');
    }
}
