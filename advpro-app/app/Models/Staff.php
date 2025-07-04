<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model // ¡Asegúrate de que sea 'Staff' con 'S' mayúscula!
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'documento',
        'email',
        'telefono',
        'direccion',
        'cargo',
        'estado',
    ];

    // Si un Staff puede estar asociado a varios Proyectos
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'responsable', 'id'); // Asumiendo 'responsable' es FK en proyectos
    }

    // Si un Staff puede ser responsable de varios Equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'responsable', 'id'); // Asumiendo 'responsable' es FK en equipos
    }

    public function contratos()
{
    return $this->hasMany(Contrato::class, 'id_responsable');
}
}
