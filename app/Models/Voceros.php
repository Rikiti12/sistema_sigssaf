<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voceros extends Model
{
    use HasFactory;

    protected $table = 'voceros'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'cedula', 'nombre', 'apellido', 'fecha_nacimiento', 'edad', 'genero', 'telefono', 'correo','direccion', 'cargo', 'tipo_vocero'];

    public function consejo_comunals()
    {
        return $this->hasMany(ConsejoComunal::class, 'id_vocero');
    }

    public function comuna()
    {
        return $this->hasMany(Comunas::class, 'id_vocero');
    }
}
