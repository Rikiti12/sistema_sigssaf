<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comunas;
use App\Models\Comunidades;
use App\Models\ConsejoComunal;
use App\Models\Personas;
use App\Models\AyudaSociales;
use App\Models\Viviendas;
use App\Models\Proyectos;

class homeController extends Controller
{
    //
    public function index(){

        $comunas = Comunas::all();
        $count_comuna = DB::table('comunas')
        ->count();

        $comunidades = Comunidades::all();
        $count_comunidad = DB::table('comunidades')
        ->count();

        $consejocomunal = ConsejoComunal::all();
        $count_consejo = DB::table('consejo_comunals')
        ->count();

        $personas = Personas::all();
        $count_persona = DB::table('personas')
        ->count();

        $ayuda_sociales = AyudaSociales::all();
        $count_ayuda = DB::table('ayuda_sociales')
        ->count();

        $viviendas = Viviendas::all();
        $count_vivienda = DB::table('viviendas')
        ->count();


        return view('home.inicio' , compact('count_comuna', 'count_comunidad', 'count_consejo', 'count_persona', 'count_ayuda', 'count_vivienda'  ) ,  [
        'count' => $count_comuna, $count_comunidad, $count_consejo, $count_persona, $count_ayuda, $count_vivienda

        ]); 

    }

}