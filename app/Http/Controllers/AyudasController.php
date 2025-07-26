<?php

namespace App\Http\Controllers;

use App\Models\Ayudas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;


class AyudasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayudas = Ayudas::all();
        return view('ayuda.index', compact('ayudas'));
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $ayudas = Ayudas::where('nombre_ayuda', 'LIKE', '%' . $search . '%')
                           ->orWhere('tipo_ayuda', 'LIKE', '%' . $search . '%')
                           ->orWhere('descripcion', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $ayudas = Ayudas::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('ayuda.pdf', compact('ayudass'));
        return $pdf->stream('ayuda.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ayudas = Ayudas::all();
        return view('ayuda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ayudas = new Ayudas();
        $ayudas->nombre_ayuda = $request->input('nombre_ayuda');
        $ayudas->tipo_ayuda = $request->input('tipo_ayuda');
        $ayudas->descripcion = $request->input('descripcion');

        $ayudas->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('ayuda.index');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ayudas  $ayudas
     * @return \Illuminate\Http\Response
     */
    public function show(Ayudas $ayudas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ayudas  $ayudas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ayuda = Ayudas::find($id);
        return view('ayuda.edit', compact('ayuda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ayudas  $ayudas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ayuda = Ayudas::find($id);
        $ayuda->nombre_ayuda = $request->input('nombre_ayuda');
        $ayuda->tipo_ayuda = $request->input('tipo_ayuda');
        $ayuda->descripcion = $request->input('descripcion');

        $ayuda->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('ayuda');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ayudas  $ayudas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ayudas::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('ayuda.index')->with('eliminar', 'ok');
    }
}
