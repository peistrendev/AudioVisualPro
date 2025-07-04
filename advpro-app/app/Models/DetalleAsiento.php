<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleAsiento extends Model
{
    protected $table = 'detalle_asiento';
    protected $primaryKey = 'id_detalle';
    protected $fillable = ['id_asiento', 'id_cuenta', 'debe', 'haber', 'descripcion_linea'];

    public function asiento(): BelongsTo {
        return $this->belongsTo(Contabilidad::class, 'id_asiento');
    }

    public function cuenta(): BelongsTo {
        return $this->belongsTo(CuentaContable::class, 'id_cuenta');
    }
}
?>