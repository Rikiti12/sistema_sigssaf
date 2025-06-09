<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsejoComunal extends Model
{
    use HasFactory;

    protected $table = 'consejo_comunals'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nom_consej','situr', 'rif', 'acta','dire_consejo','id_vocero', 'id_comunidad'];

    public function vocero()
    {
        return $this->belongsTo(Voceros::class, 'id_vocero');
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidades::class, 'id_comunidad');
    }
}
