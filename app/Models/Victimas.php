<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victimas extends Model
{
    use HasFactory;

    protected $table = 'victimas'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'nombre', 'apellido', 'edad'];

    // public function municipio()
    // {
    //     return $this->belongsTo(Municipio::class, 'id_municipio');
    // }
}
