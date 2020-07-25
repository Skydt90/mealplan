<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Day extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'week_id', 'chef', 'date'
    ];

    public function meal()
    {
        return $this->hasOne(Meal::class);
    }

    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date'])->format('D d / m');
    }
}
