<?php

// app/Models/Proyecto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    // Agrega la propiedad $fillable con todas las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'estado',
        'lugar',
        'responsable', //llave foranea a la tabla 'staff'
    ];

    public function staff()
     {
         return $this->belongsTo(staff::class); // Asumiendo 'responsable' es el foreign key
     }
}