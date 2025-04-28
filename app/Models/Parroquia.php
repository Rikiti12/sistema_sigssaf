<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    use HasFactory;

    protected $table = 'parroquias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'nom_parroquia'];

    // public function comisionados()
    // {
    //     return $this->belongsToMany(Comisionados::class, 'municipio_comisionados' , 'id_comisionado', 'id_municipio');
    // }

}
