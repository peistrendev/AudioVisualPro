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
        'cliente', // Asumiendo que 'cliente' es una columna directa que guarda el ID o nombre del cliente
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'estado',
        'lugar',
        'responsable',
    ];

    // Opcional: Si 'cliente' es una clave foránea a la tabla 'clientes', puedes definir la relación
    // public function cliente()
     {
         return $this->belongsTo(Clientes::class, 'cliente'); // Asumiendo 'cliente' es el foreign key
     }
}