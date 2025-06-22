<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente; 
use App\Models\Staff; 

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