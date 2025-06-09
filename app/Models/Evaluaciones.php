<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_proyecto','fecha_evalu','respon_evalu','observaciones','estado_evalu','viabilidad','documentos'];

    // Relación con Proyecto
    public function proyectos()
    {
        return $this->belongsTo(Proyectos::class, 'id_proyecto');
    }

    // Accesor para los documentos (convertir de JSON a array automáticamente)
    public function getDocumentosAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    // Mutador para los documentos (convertir de array a JSON automáticamente)
    public function setDocumentosAttribute($value)
    {
        $this->attributes['documentos'] = json_encode($value);
    }

    // Scope para evaluaciones pendientes
    public function scopePendientes($query)
    {
        return $query->where('estado_evalu', 'Pendiente');
    }

    // Scope para evaluaciones completadas
    public function scopeCompletadas($query)
    {
        return $query->where('estado_evalu', 'Completada');
    }

    // Scope para evaluaciones aprobadas
    public function scopeAprobadas($query)
    {
        return $query->where('estado_evalu', 'Aprobada');
    }
}