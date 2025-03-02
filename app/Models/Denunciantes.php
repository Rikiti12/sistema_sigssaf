<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denunciantes extends Model
{
    use HasFactory;

    protected $table = 'denunciantes'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['cedula', 'nombre', 'apellido', 'telefono', 'id_municipio', 'direccion'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
}
