<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cargos;
use App\Models\Comunas;
use App\Models\Comunidades;
use App\Models\ConsejoComunal;
use App\Models\Voceros;
use App\Models\Ayudas;
use App\Models\Proyectos;
use App\Models\Resposanbles;
use App\Models\Evaluaciones;
use App\Models\Asignaciones;
use App\Models\Planificaciones;
use App\Models\Seguimientos;


class homeController extends Controller
{
    //
    public function index(){

        $cargos = cargos::all();
        $count_cargo = DB::table('cargos')
        ->count();

        $voceros = Voceros::all();
        $count_vocero = DB::table('voceros')
        ->count();

        $comunidades = Comunidades::all();
        $count_comunidad = DB::table('comunidades')
        ->count();

        $consejocomunal = ConsejoComunal::all();
        $count_consejo = DB::table('consejo_comunals')
        ->count();

        $comunas = Comunas::all();
        $count_comuna = DB::table('comunas')
        ->count();

        $ayudas = Ayudas::all();
        $count_ayuda = DB::table('ayudas')
        ->count();
        
        $proyectos = Proyectos::all();
        $count_proyecto = DB::table('proyectos')
        ->count();

         $resposanbles = Resposanbles::all();
        $count_resposanble = DB::table('resposanbles')
        ->count();

        $evaluaciones = Evaluaciones::all();
        $count_evaluacion = DB::table('evaluaciones')
        ->count();

        $asignaciones = Asignaciones::all();
        $count_asignacion = DB::table('asignaciones')
        ->count();

        $seguimientos = Seguimientos::all();
        $count_seguimiento = DB::table('seguimientos')
        ->count();
       

        $mapa_asignaciones = asignaciones::select('latitud','longitud')->get();

        return view('home.inicio' , compact('count_cargo', 'count_vocero', 'count_comunidad', 'count_consejo', 'count_comuna','count_ayuda','count_proyecto','count_resposanble','count_evaluacion',
        'count_asignacion', 'count_seguimiento', 'mapa_asignaciones'  ) ,  [
        'count' =>   $count_cargo, $count_vocero, $count_comunidad, $count_consejo, $count_comuna,  $count_ayuda,$count_proyecto,$count_resposanble, $count_evaluacion, $count_asignacion, $count_seguimiento

        ]); 

    }

}