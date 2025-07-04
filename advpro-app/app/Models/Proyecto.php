<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Staff; // Asegúrate de que este modelo está importado

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'cliente_id',     // Mantenemos 'cliente_id' porque así se llamará en la DB
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'estado',
        'lugar',
        'responsable_id', // ¡CAMBIADO a 'responsable_id' para consistencia!
    ];
    
    /**
     * Relación: Un Proyecto pertenece a un Cliente.
     * Laravel infiere 'cliente_id' como clave foránea por convención.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    /**
     * Relación: Un Proyecto pertenece a un Responsable (Staff).
     * Especificamos 'responsable_id' como la clave foránea.
     */
    public function responsable()
    {
        return $this->belongsTo(Staff::class, 'responsable_id', 'id');
    }
}
