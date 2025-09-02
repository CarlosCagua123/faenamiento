<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $fillable = ['codigo','fecha_ingreso','proveedor'];

    public function cerdos() {
        return $this->hasMany(Cerdo::class);
    }
}
