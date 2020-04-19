<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function outsourcing()
    {
        return $this->belongsTo('App\Models\Outsourcing');
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Bagian');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan');
    }
}
