<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_proyecto', 'fecha_evalu', 'respon_evalu', 'observaciones', 'estatus', 'estatus_resp', 'viabilidad'];

    // Relación con Proyecto
    public function proyectos()
    {
        return $this->belongsTo(Proyectos::class, 'id_proyecto');
    }

     public function asignaciones()
    {
        return $this->hasMany(Asignaciones::class, 'id_evaluacion');
    }

}