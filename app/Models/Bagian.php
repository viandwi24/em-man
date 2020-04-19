<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'bagian';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->hasOne('App\Models\Karyawan');
    }
}
