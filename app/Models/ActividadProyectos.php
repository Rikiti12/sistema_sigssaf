<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadProyectos extends Model
{
    use HasFactory;
    protected $table = 'actividad_proyectos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_proyecto', 'id_actividad'];
}
