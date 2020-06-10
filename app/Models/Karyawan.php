<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $guarded = [];

    public function pendidikan()
    {
        return $this->hasOne('App\Models\KaryawanPendidikan');
    }

    public function keluarga()
    {
        return $this->hasMany('App\Models\KaryawanKeluarga');
    }

    public function orangtua()
    {
        return $this->hasMany('App\Models\KaryawanOrangtua');
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

    public function peringatan()
    {
        return $this->hasMany('App\Models\Peringatan');
    }

    public function cuti()
    {
        return $this->hasMany('App\Models\Cuti');
    }

    public function mutasi()
    {
        return $this->hasMany('App\Models\Mutasi');
    }
}
