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
    protected $fillable = [ 'id_parroquia','nombre_pro','descripcion_pro','tipo_pro', 'id_ayuda', 'actividades', 'cantidad_bene','fecha_inicial', 'fecha_final',
    'prioridad', 'acta_conformidad'];

    public function ayuda()
    {
        return $this->belongsTo(Ayudas::class, 'id_ayuda');
    }

    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class, 'id_parroquia');
    }
    
}
