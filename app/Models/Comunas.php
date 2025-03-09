<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunas extends Model
{
    use HasFactory;

    protected $table = 'comunas'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['cedula_comunas', 'nombre_comunas', 'apellido_comunas','telefono', 'nom_comunas','dire_comunas'];

    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class, 'id_parroquia');
    }
}
