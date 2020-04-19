<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outsourcing extends Model
{
    protected $table = 'outsourcing';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->hasOne('App\Models\Karyawan');
    }
}
