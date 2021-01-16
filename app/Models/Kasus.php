<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    use HasFactory;
    public function negara()
    {
        return $this->belongsTo('App\Models\Negara','id_neg');
    }
}
