<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Victimas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class VictimasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $victimas = Victimas::all();
        return view('victima.index', compact('victimas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('victima.create');
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
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required',
          
       ]);

        $victimas = new Victimas();
        $victimas->nombre = $request->input('nombre');
        $victimas->apellido = $request->input('apellido');
        $victimas->edad = $request->input('edad');
       

        $victimas->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
        
            return redirect()->route('victima.index');

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