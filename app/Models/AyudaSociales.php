<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyudaSociales extends Model
{
    use HasFactory;

    protected $table = 'ayuda_sociales';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre_ayu', 'descripcion'];

}