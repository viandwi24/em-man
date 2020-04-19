<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peringatan extends Model
{
    protected $table = 'peringatan';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan');
    }
}
