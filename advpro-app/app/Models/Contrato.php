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
        'fecha_contrato',
        'costo',
        'estado',
    ];

    protected $casts = [
        'fecha_contrato' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

}
