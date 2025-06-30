<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente; // ¡Importa el modelo Cliente!
use App\Models\Staff; // También necesitarás el modelo Staff si lo usas para 'responsable' o en otras relaciones

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'cliente_id',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'estado',
        'lugar',
        'responsable_id',
    ];
    
        public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function responsable()
    {
        return $this->belongsTo(Staff::class);
    }

}