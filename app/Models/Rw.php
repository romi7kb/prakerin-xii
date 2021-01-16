<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;
    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahan','id_kel');
    }
    public function tracking()
    {
        return $this->hasOne('App\Models\Tracking','id_rw');
    }
}
