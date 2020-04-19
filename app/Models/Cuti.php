<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cuti';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan');
    }
}
