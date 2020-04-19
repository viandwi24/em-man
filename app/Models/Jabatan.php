<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->hasOne('App\Models\Karyawan');
    }
}
