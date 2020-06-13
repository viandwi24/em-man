<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pelatihan';
    protected $guarded = [];

    protected $casts = [
        'usulan' => 'object',
        'materi' => 'object',
        'laporan' => 'object',
        'evaluasi' => 'object',
        'terbit' => 'date',
        'pelatihan' => 'date',
    ];

    public function karyawan()
    {
        return $this->belongsToMany('App\Models\Karyawan', 'pelatihan_karyawan');
    }
}