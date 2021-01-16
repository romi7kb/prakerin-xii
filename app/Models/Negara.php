<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;
    public function kasus()
    {
        return $this->hasOne('App\Models\Kasus','id_neg');
    }
}
