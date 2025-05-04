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
    protected $fillable = ['id_planificacion', 'fecha_segui','responsable_segui','detalle_segui','estatus', 'estatus_res',
    ];

    // Relaciones
    public function planificacion() // planificacion
    {
        return $this->belongsTo(Planificaciones::class, 'id_planificacion'); 
    }
}
