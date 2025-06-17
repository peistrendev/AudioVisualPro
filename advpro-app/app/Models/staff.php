<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class staff extends Model
{
     use HasFactory;
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
        return $this->hasMany(Proyecto::class);
    }
}
