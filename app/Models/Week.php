<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Week extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'start_date',
        'end_date'
    ];

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function getStartDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['start_date'])->format('d/m');
    }

    public function getEndDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->format('d/m');
    }
}
