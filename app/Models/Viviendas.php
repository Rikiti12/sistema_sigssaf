<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viviendas extends Model
{
    use HasFactory;

    protected $table = 'viviendas';
    protected $primaryKey = 'id';
    public $timestamps = true;
     protected $fillable = ['dire_vivie', 'tipo_vivie', 'id_persona'];

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }

    //     public function comunidad()
    //     {
     //         return $this->belongsTo(Comunas::class, 'id_comunidad');
    //     }
}