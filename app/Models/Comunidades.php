<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidades extends Model
{
    use HasFactory;

    protected $table = 'comunidades'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nom_comuni', 'dire_comuni','tipo_comunidad','tipo_vivienda'];
    
}
