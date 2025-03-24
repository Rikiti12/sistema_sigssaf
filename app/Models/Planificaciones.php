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
    protected $fillable = [ 'nombre_pro','descripcion_pro', 'id_proyecto','fecha_inicial','status_pro',
    ];

    // Relaciones 
    public function proyecto()
    {
        return $this->belongsTo(Proyectos::class, 'id_proyecto');
    }

//     public function comunidad()
//     {
//         return $this->belongsTo(Comunidades::class, 'id_comunidad');
//     }

}
