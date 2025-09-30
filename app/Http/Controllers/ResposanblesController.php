<?php

namespace App\Http\Controllers;

use App\Models\Resposanbles;
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
        $resposanbles = Resposanbles::all();
        return view('resposanble.index', compact('resposanbles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Resposanbles $resposanbles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resposanbles  $resposanbles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resposanbles $resposanbles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resposanbles  $resposanbles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resposanbles $resposanbles)
    {
        //
    }
}
