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
    protected $fillable = [ 'nombre_pro','descripcion_pro','id_persona','id_comunidad','fecha_inicial','status_pro',
    ];

    // Relaciones (si es necesario)
    public function persona()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidades::class, 'id_comunidad');
    }
}