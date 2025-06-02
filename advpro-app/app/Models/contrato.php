<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contrato extends Model
{
    protected $table = 'contratos';

    public function Clientes(){
        return $this->hasMany(Clientes::class);
    }
}
