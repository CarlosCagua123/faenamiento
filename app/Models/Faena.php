<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faena extends Model
{
    protected $fillable = ['cerdo_id','fecha','categoria','observaciones'];

    public function cerdo() {
        return $this->belongsTo(Cerdo::class);
    }
    public function pesajes() {
        return $this->hasMany(Pesaje::class);
    }
    public function inspecciones() {
        return $this->hasMany(Inspeccion::class);
    }
}
