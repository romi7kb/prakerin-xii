<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $fillable = ['kode_prov','nama_prov'];
    public $timestams = true;
    public function kota()
    {
        return $this->hasMany('App\Models\Provinsi','id_prov');
    }
}
