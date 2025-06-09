<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificaciones extends Model
{
    use HasFactory;

    protected $table = 'planificaciones'; 
    protected $primaryKey = 'id'; 
    public $timestamps = true; 
    protected $fillable = [ 'id_asignacion', 'descri_alcance','moneda_presu', 'presupuesto', 'impacto_ambiental', 'impacto_social', 'descri_obra', 'fecha_inicio', 'duracion_estimada',
    ];
    
    // Relaciones 
    public function asignacion()
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion');
    }

}
