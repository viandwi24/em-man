<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
    protected $table = 'rencana';
    protected $guarded = [];

    protected $casts = [
        'jadwal' => 'array'
    ];
}
