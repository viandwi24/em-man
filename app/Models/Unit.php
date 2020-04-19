<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->hasOne('App\Models\Karyawan');
    }
}
