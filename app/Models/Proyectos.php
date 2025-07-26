<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table = 'proyectos'; 
    protected $primaryKey = 'id'; 
    public $timestamps = true; 
    protected $fillable = [ 'nombre_pro','descripcion_pro','tipo_pro', 'id_ayuda', 'actividades', 'fecha_inicial', 'fecha_final',
    'prioridad', 'acta_conformidad'];

    public function ayuda()
    {
        return $this->belongsTo(Ayudas::class, 'id_ayuda');
    }

    // public function actividades()
    // {
    //     return $this->belongsToMany(actividades::class, 'actividad_proyectos', 'id_proyecto', 'id_actividad');
    // }
    
}
