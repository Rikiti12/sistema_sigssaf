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
    protected $fillable = [ 'cedula_voce', 'nom_voce', 'ape_voce', 'telefono', 'codigo_situr', 'rif', 'acta','dire_consejo','id_comunidad'];

     public function comunidad()
    {
        return $this->belongsTo(Comunidades::class, 'id_comunidad');
    }
}
