<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    protected $fillable = ['faena_id','inspector','resultado','observaciones'];

    public function faena() {
        return $this->belongsTo(Faena::class);
    }
}
