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
                           ->orWhere('foto_ayuda', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $ayudas = Ayudas::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('ayuda.pdf', compact('ayudas'));
        return $pdf->stream('ayuda.pdf');
    }

    public function getayudaDetalles($id)
    {
        // Recupera el Ayuda por su ID
        $ayuda = Ayudas::find($id);

        if (!$ayuda) {
            // Maneja el caso en que no se encuentre la ayuda
            return response()->json(['error' => 'La Ayuda no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'foto_ayuda' => $ayuda->foto_ayuda,
            
        ]);
 
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
        $this->validate($request, [
            'foto_ayuda' => 'required|array|min:1',
            'foto_ayuda.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'foto_ayuda.required' => 'Debe registrar una o más fotos.',
            'foto_ayuda.min' => 'Debe registrar al menos una foto.',
            'foto_ayuda.*.image' => 'Cada archivo debe ser una imagen.',
            'foto_ayuda.*.mimes' => 'Las imágenes deben ser de tipo jpeg, png, jpg, gif o svg.',
        ]);

        $ayudas = new Ayudas();
        $ayudas->nombre_ayuda = $request->input('nombre_ayuda');
        $ayudas->tipo_ayuda = $request->input('tipo_ayuda');
        $ayudas->descripcion = $request->input('descripcion');

        if ($request->hasFile('foto_ayuda')) {
            $rutaGuardarDocs = 'foto_ayuda/ayudas/';
            $nombresAyudas = [];
    
            foreach ($request->file('foto_ayuda') as $foto_ayuda) {
                $nombreAyuda = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto_ayuda->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto_ayuda->getClientOriginalExtension();
                $foto_ayuda->move(public_path($rutaGuardarDocs), $nombreAyuda);
                $nombresAyudas[] = $nombreAyuda;
            }
    
                $ayudas->foto_ayuda = json_encode($nombresAyudas);
            }

        $ayudas->save();

        //$bitacora = new BitacoraController();
        //$bitacora->update();

        try {
            return redirect()->route('ayuda.index')->with('success', '✅ La ayuda ha sido Guardada exitosamente.');
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
        $foto_ayuda = $ayuda->foto_ayuda;
        return view('ayuda.edit', compact('ayuda', 'foto_ayuda'));
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

         // Verificar si se han cargado nuevos archivos
         if ($request->hasFile('foto_ayuda')) {
            $rutaGuardarImg = 'foto_ayuda/ayudas/';
            $nombresAyudas = [];

            foreach ($request->file('foto_ayuda') as $foto_ayuda) {
                $nombreAyuda = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto_ayuda->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto_ayuda->getClientOriginalExtension();
                $foto_ayuda->move(public_path($rutaGuardarImg), $nombreAyuda);
                $nombresAyudas[] = $nombreAyuda;
            }

            // Actualizar las imágenes
            $ayuda->foto_ayuda = json_encode($nombresAyudas);
        }

        $ayuda->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('ayuda')->with('success', '✅ El ayuda ha sido Actualizado exitosamente.');
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
