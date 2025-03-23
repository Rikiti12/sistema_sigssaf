<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AyudaSociales;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class AyudaSocialesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-ayuda_sociales|crear-ayuda_sociales|editar-ayuda_sociales|borrar-ayuda_sociales', ['only' => ['index']]);
        $this->middleware('permission:crear-ayuda_sociales', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-ayuda_sociales', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-ayuda_sociales', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayuda_sociales = AyudaSociales::all(); 
        return view('ayuda_sociales.index', compact('ayuda_sociales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ayuda_sociales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $ayuda_sociales = new AyudaSociales();
        $ayuda_sociales->nombre_ayu = $request->input('nombre_ayu');
        $ayuda_sociales->descripcion = $request->input('descripcion');

        $ayuda_sociales->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('ayuda_sociales.index');
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
        // No se usa en este caso, pero puedes implementarlo si es necesario
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ayuda_social = AyudaSociales::find($id);
        return view('ayuda_sociales.edit', compact('ayuda_social'));
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

        $ayuda_social = AyudaSociales::find($id);
        $ayuda_social->nombre_ayu = $request->input('nombre_ayu');
        $ayuda_social->descripcion = $request->input('descripcion');

        $ayuda_social->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('ayuda_sociales');

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
        AyudaSociales::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('ayuda_sociales.index')->with('eliminar', 'ok');
    }

}