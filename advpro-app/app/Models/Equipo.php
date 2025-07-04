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
        'valor',
    ];

    /**
     * Get the staff member who is responsible for the equipment.
     */
    public function personal() // Puedes llamarlo 'responsableStaff' o 'staff'
    {
        return $this->belongsTo(Staff::class, 'responsable', 'id');
    }

    /* protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    */
}