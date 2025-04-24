<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ControlSeguimientos;
use App\Models\Seguimientos;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;


class ControlSeguimientosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-controlseguimiento|crear-controlseguimiento', ['only' => ['index']]);
        $this->middleware('permission:crear-controlseguimiento', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguimientos = Seguimientos::all();
        return view('control_seguimiento.index', compact('seguimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
}
