<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    
    protected $table = 'staff';

    // Agrega la propiedad $fillable
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
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'responsable'); // Asumiendo 'responsable' es el foreign key en la tabla 'proyectos'
    }
}
