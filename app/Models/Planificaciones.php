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
    protected $fillable = [ 'id_proyecto', 'descri_alcance', 'presupuesto', 'impacto_ambiental', 'impacto_social', 'descri_obra', 'fecha_inicio', 'duracion_estimada',
    ];
    
    // Relaciones 
    public function proyecto()
    {
        return $this->belongsTo(Proyectos::class, 'id_proyecto');
    }

}
