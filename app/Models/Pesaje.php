<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesaje extends Model
{
    protected $fillable = ['faena_id','tipo','peso'];

    public function faena() {
        return $this->belongsTo(Faena::class);
    }
}
