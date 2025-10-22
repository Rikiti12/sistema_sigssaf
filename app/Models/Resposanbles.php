<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposanbles extends Model
{
    use HasFactory;
    protected $table = 'resposanbles'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'cedula', 'nombre', 'apellido'];

    public function evaluaciones()
    {
        return $this->hasMany(Evaluaciones::class, 'id_resposanble');
    }

}
