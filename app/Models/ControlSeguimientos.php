<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlSeguimientos extends Model
{
    use HasFactory;
     protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [];

    // Relaciones
    public function seguimiento() // planificacion
    {
        return $this->belongsTo(Seguimientos::class, 'id_seguimiento'); 
    }
}
