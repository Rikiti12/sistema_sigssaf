<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'nombre_cargo', 'categoria'];

    public function vocero()
    {
        return $this->hasMany(Voceros::class, 'id_cargo');
    }
}
