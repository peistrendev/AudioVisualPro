<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'tipo_equipo',
        'estado',
        'ubicacion',
        'responsable',
    ];

    /* protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    */
}

