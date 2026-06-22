<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
        'fecha',
        'creado_por',
        'asignado_a',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function asignadoA()
    {
        return $this->belongsTo(User::class, 'asignado_a');
    }

    public function scopePorEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    public function scopeAsignadoA($query, $usuarioId)
    {
        return $query->where('asignado_a', $usuarioId);
    }

    public function scopeCreadoPor($query, $usuarioId)
    {
        return $query->where('creado_por', $usuarioId);
    }

    public function getEtiquetaEstadoAttribute(): string
    {
        return match ($this->estado) {
            'pendiente'   => 'Pendiente',
            'en_progreso' => 'En progreso',
            'completada'  => 'Completada',
            default       => $this->estado,
        };
    }

    public function getEtiquetaPrioridadAttribute(): string
    {
        return match ($this->prioridad) {
            'baja'  => 'Baja',
            'media' => 'Media',
            'alta'  => 'Alta',
            default => $this->prioridad,
        };
    }

    public function getColorEstadoAttribute(): string
    {
        return match ($this->estado) {
            'pendiente'   => 'warning',
            'en_progreso' => 'info',
            'completada'  => 'success',
            default       => 'secondary',
        };
    }

    public function getColorPrioridadAttribute(): string
    {
        return match ($this->prioridad) {
            'baja'  => 'success',
            'media' => 'warning',
            'alta'  => 'danger',
            default => 'secondary',
        };
    }
}