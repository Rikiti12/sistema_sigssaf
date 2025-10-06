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
    protected $fillable = ['id_proyecto', 'fecha_evalu', 'id_resposanble', 'observaciones', 'estatus', 'estatus_resp', 'viabilidad'];

    // Relación con Proyecto
    public function proyectos()
    {
        return $this->belongsTo(Proyectos::class, 'id_proyecto');
    }

    public function resposanbles()
    {
        return $this->belongsTo(Resposanbles::class, 'id_resposanble');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignaciones::class, 'id_evaluacion');
    }

}