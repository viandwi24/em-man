<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';
    protected $guarded = [];
    protected $appends = ['diff'];

    public function getDiffAttribute()
    {
        return Carbon::parse($this->mulai)->format('F Y')
            . ' - ' . Carbon::parse($this->selesai)->format('F Y');
    }
}