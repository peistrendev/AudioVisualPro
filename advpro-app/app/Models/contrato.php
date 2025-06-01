<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos'; // Nombre de la tabla en la BD
    protected $primaryKey = 'id'; // Llave primaria

    protected $fillable = [
        'id_cliente',
        'id_proyecto',
        'id_responsable',
        'fecha_contrato',
        'tipo_contrato',
        'tiempo_contrato',
        'estado',
        'observaciones',
        'documento'
    ];

    protected $casts = [
        'fecha_contrato' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'id_responsable'); // Ajusta el modelo si es diferente
    }
}
