<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayudas extends Model
{
    use HasFactory;
    protected $table = 'ayudas'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'nombre_ayuda', 'tipo_ayuda', 'descripcion', 'foto_ayuda'];

    public function proyecto()
    {
        return $this->hasMany(Proyectos::class, 'id_ayuda');
    }
}
