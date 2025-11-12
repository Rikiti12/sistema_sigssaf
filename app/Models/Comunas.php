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
    protected $fillable = ['nom_comunas','rif_comuna','id_parroquia','id_consejo', 'id_vocero', 'dire_comunas'];

    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class, 'id_parroquia');
    }

    public function consejo_comunals()
    {
        return $this->belongsTo(ConsejoComunal::class, 'id_consejo');
    }

    public function vocero()
    {
        return $this->belongsTo(Voceros::class, 'id_vocero');
    }

}
