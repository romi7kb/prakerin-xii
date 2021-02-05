<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    public $fillable = ['positif','sembuh','meninggal','tgl'];
    public function rw()
    {
        return $this->belongsTo('App\Models\Rw','id_rw');
    }
}
