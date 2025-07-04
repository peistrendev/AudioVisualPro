<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CuentaContable extends Model
{
    protected $table = 'cuenta_contable';
    protected $primaryKey = 'id_cuenta';
    protected $fillable = ['codigo', 'nombre', 'tipo', 'es_ajustable', 'cuenta_padre_id'];

    public function hijos(): HasMany {
        return $this->hasMany(CuentaContable::class, 'cuenta_padre_id');
    }

    public function detalles(): HasMany {
        return $this->hasMany(DetalleAsiento::class, 'id_cuenta');
    }
}
?>