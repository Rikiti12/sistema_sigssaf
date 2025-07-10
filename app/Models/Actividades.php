<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use HasFactory;

    protected $table = 'actividades';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'nom_actividad'];

    public function proyectos()
    {
        return $this->belongsToMany(Proyectos::class, 'actividad_proyectos' , 'id_proyecto', 'id_actividad');
    }

}
