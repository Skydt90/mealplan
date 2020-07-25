<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'effort', 'name'
    ];
    public const CHEFS = [
        'Chr', 'Cam'
    ];
    public const EFFORT = [
        1 => 'Ingen', 2 => 'Nemt', 3 => 'Gennemsnitlig', 4 => 'Omfattende'
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
