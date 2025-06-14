<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;

    protected $table = 'asignaciones'; 
    protected $primaryKey = 'id'; 
    public $timestamps = true; 
    protected $fillable = [ 'id_vocero','id_comunidad','imagenes','latitud','longtud','direccion'];

    // Relaciones (si es necesario)
    public function voceros()
    {
        return $this->belongsTo(Voceros::class, 'id_vocero');
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidades::class, 'id_comunidad');
    }

    public function planificaciones()
    {
        return $this->hasMany(Planificaciones::class, 'id_asignacion'); // 'id_asignacion' es la clave foránea en 'planificaciones'
    }

}