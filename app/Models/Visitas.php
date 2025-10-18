<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    use HasFactory;
     use HasFactory;
    protected $table = 'proyectos'; 
    protected $primaryKey = 'id'; 
    public $timestamps = true; 
    protected $fillable = [ 'id_resposanble','visita','descripcion_vis','fecha_visita','foto_visita'];

    public function resposanbles()
    {
        return $this->belongsTo(Resposanbles::class, 'id_resposanble');
    }

}
