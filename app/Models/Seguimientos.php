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
    protected $fillable = ['id_asignacion', 'fecha_hor','responsable_segui','detalle_segui','gasto','estado_actual','riesgos'
    ];

    // Relaciones
    public function asignacion() // planificacion
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion'); 
    }
}
