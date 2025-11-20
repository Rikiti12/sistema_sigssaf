<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimientos extends Model
{
    use HasFactory;

    protected $table = 'seguimientos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_asignacion', 'id_visita', 'responsable_segui', 'fecha_hor', 'detalle_segui','gasto', 'moneda','evidencia_segui','estado_actual','riesgos'];

    // Relaciones
    public function asignacion() // planificacion
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion'); 
    }

    public function resposanbles()
    {
     
        return $this->belongsTo(Resposanbles::class, 'responsable_segui');
    }

    public function visita()
    {
        return $this->belongsTo(Visitas::class, 'id_visita');
    }

    public function control_seguimiento()
    {
        return $this->belongsToMany(ControlSeguimientos::class, 'id_seguimiento', 'id', 'id_asignacion');
    }
}
