<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitante;
use App\Models\PersonaNatural;
use App\Models\PersonaJuridica;
use App\Models\Recaudos;
use App\Models\Comisionados;
use App\Models\Minerales;
use App\Models\PagoRegalia;
use App\Models\Plazos;
use App\Models\TipoPago;
use App\Models\Banco;
use App\Models\Recepcion;
use App\Models\Inspecciones;
use App\Models\Licencias;


class homeController extends Controller
{
    //
    public function index(){

        return view('home.inicio');

    }

}