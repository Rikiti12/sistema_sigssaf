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
    protected $fillable = ['id_proyecto', 'fecha_segui','responsable_segui','detalle_segui','estatus_proye',
    ];

    // Relaciones
    public function proyecto() // proyecto
    {
        return $this->belongsTo(Proyectos::class, 'id_proyecto'); 
    }
}
