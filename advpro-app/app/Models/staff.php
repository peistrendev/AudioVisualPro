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
    ];
}
