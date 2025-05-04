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
    protected $fillable = [ 'id_persona','id_comunidad','nombre_pro','descripcion_pro','imagenes','latitud','longtud','direccion','fecha_inicial', 'fecha_final'];

    // Relaciones (si es necesario)
    public function personas()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidades::class, 'id_comunidad');
    }

    public function planificaciones()
    {
        return $this->hasMany(Planificaciones::class, 'id_proyecto'); // 'id_proyecto' es la clave foránea en 'planificaciones'
    }

}