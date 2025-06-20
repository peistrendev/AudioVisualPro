<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente; // ¡Importa el modelo Cliente!
use App\Models\Staff; // También necesitarás el modelo Staff si lo usas para 'responsable' o en otras relaciones

class Proyecto extends Model
{
    protected $table = 'proyectos';

    // Agrega la propiedad $fillable con todas las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'id', // Esta columna en 'proyectos' es la clave foránea al ID del cliente
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'estado',
        'lugar',
        'responsable',
    ];

    /**
     * Define la relación: Un proyecto pertenece a un cliente.
     * Laravel buscará el ID del cliente en la columna 'cliente' de la tabla 'proyectos'.
     */
    public function cliente()
    {
        // El primer argumento es el modelo relacionado.
        // El segundo argumento es la clave foránea en la tabla 'proyectos' que referencia a 'clientes'.
        return $this->belongsTo(Cliente::class, 'id');
    }

    // Si 'responsable' fuera una clave foránea a un modelo 'Staff' por ID, podrías tener esto:
    // public function staffResponsable()
    // {
    //     return $this->belongsTo(Staff::class, 'responsable'); // Asumiendo 'responsable' es el ID del staff
    // }
    // Sin embargo, por lo que hemos visto, 'responsable' es un string directo con el nombre.
}