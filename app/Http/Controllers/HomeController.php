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
use App\Models\Visitas;
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

        $visitas = Visitas::all();
        $count_visita = DB::table('visitas')
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

        $parroquiasDeseadas = ['Albarico', 'San Felipe', 'San Javier'];

        // 1. Obtener los conteos uniendo la tabla 'proyectos' y 'parroquias'
        $resultadosDB = DB::table('proyectos')
            // Unir con la tabla 'parroquias' usando las claves correctas
            ->join('parroquias', 'proyectos.id_parroquia', '=', 'parroquias.id')
            // Filtrar solo las parroquias deseadas por su nombre
            ->whereIn('parroquias.nom_parroquia', $parroquiasDeseadas)
            // Agrupar por el nombre de la parroquia
            ->groupBy('parroquias.nom_parroquia')
            // Seleccionar el nombre y el conteo
            ->select('parroquias.nom_parroquia', DB::raw('count(*) as total_proyectos'))
            ->get();

        // 2. Mapear los resultados
        $mapaResultados = $resultadosDB->pluck('total_proyectos', 'nom_parroquia')->toArray();

        // 3. Crear el array final y garantizar las 3 parroquias con el conteo
        $proyectosPorParroquia = [];
        $totalGeneral = 0; 

        foreach ($parroquiasDeseadas as $parroquia) {
            $conteo = $mapaResultados[$parroquia] ?? 0;
            $proyectosPorParroquia[] = [
                'parroquia' => $parroquia, // Usamos el nombre para la vista
                'total' => $conteo,
            ];
            $totalGeneral += $conteo;
        }

        return view('home.inicio' , compact('count_cargo', 'count_vocero', 'count_comunidad', 'count_consejo', 'count_comuna','count_ayuda','count_proyecto','count_resposanble','count_visita','count_evaluacion',
        'count_asignacion', 'count_seguimiento', 'mapa_asignaciones', 'proyectosPorParroquia', 'parroquiasDeseadas', 'totalGeneral'  ) ,  [
        'count' =>   $count_cargo, $count_vocero, $count_comunidad, $count_consejo, $count_comuna,  $count_ayuda,$count_proyecto,$count_resposanble, $count_visita, $count_evaluacion, $count_asignacion, $count_seguimiento

        ]); 

    }

}