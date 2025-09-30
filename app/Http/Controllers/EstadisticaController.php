<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluaciones = DB::table('evaluaciones')
        ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM created_at) as mes'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
        ->get();

        $data_evaluacion = $this->preprareChartData($evaluaciones);

        $evaluaciones = DB::table('evaluaciones')
        ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM fecha_evalu) as mes'), 'estatus')
        ->whereYear('fecha_evalu', date('Y'))
        ->groupBy('estatus', DB::raw('EXTRACT(MONTH FROM fecha_evalu)'))
        ->get();

        $data_aprobado = $this->preparePieChartData($evaluaciones);

        return view('estadistica.index', compact('data_evaluacion', 'data_aprobado'));

    }

    private function preprareChartData($evaluaciones) 
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dataset = array_fill(0, 12, 0);

        foreach ($evaluaciones as $evaluacion) {
            $dataset[$evaluacion->mes - 1] = $evaluacion->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Numero de evaluaciones',
                    'data' => $dataset,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'bodercolor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 3
                ]
            ]
        ];

    }


    private function preparePieChartData($evaluaciones)
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        $aprobadas = array_fill(0, 12, 0); // Inicializar un array con 12 ceros para aprobadas
        $negados = array_fill(0, 12, 0); // Inicializar un array con 12 ceros para negados

        foreach ($evaluaciones as $evaluacion) {
            if ($evaluacion->estatus === 'Aprobado') {
                $aprobadas[$evaluacion->mes - 1] = $evaluacion->total;
            } elseif ($evaluacion->estatus === 'Negado') {
                $negados[$evaluacion->mes - 1] = $evaluacion->total;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Aprobadas',
                    'data' => $aprobadas,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 3
                ],
                [
                    'label' => 'Negados',
                    'data' => $negados,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 3
                ]
            ]
        ];
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
