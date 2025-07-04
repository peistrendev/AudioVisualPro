<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contabilidad extends Model
{
    protected $table = 'asiento_contable';
    protected $primaryKey = 'id_asiento';
    protected $fillable = ['fecha', 'descripcion'];

    public function detalles(): HasMany {
        return $this->hasMany(DetalleAsiento::class, 'id_asiento');
    }
}
?>