<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerdo extends Model
{
    protected $fillable = ['lote_id','arete','sexo','peso_inicial','fecha_nacimiento','estado'];

    public function lote() {
        return $this->belongsTo(Lote::class);
    }
    public function faenas() {
        return $this->hasMany(Faena::class);
    }
}
