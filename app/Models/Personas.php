<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;

    protected $table = 'personas'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'cedula', 'nombre', 'apellido', 'fecha_nacimiento', 'edad', 'genero', 'telefono', 'correo','direccion','discapacidad','embarazada','jefe_familia'];

}
