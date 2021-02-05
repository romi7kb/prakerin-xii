<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    public function kota()
    {
        return $this->belongsTo('App\Models\Kota','id_kot');
    }
    public function kelurahan()
    {
        return $this->hasMany('App\Models\Kelurahan','id_kec');
    }
}
