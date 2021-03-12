<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'symptom_name',
        'medicine_name',
        'medicine_days',
        'medicine_morning',
        'medicine_afternoon',
        'medicine_evening',
        'medicine_night',
        'medicine_continues',
        'ms_score',

    ];
}
