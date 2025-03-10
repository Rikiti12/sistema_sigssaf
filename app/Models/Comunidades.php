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
    protected $fillable = [ 'cedula_jefe', 'nom_jefe', 'ape_jefe', 'telefono', 'nom_comuni', 'dire_comuni', 'id_comuna'];

     public function comuna()
    {
        return $this->belongsTo(Comunas::class, 'id_comuna');
    }
}
