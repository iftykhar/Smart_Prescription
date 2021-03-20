<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_name',
        'medicine_days',
        'medicine_morning',
        'medicine_afternoon',
        'medicine_evening',
        'medicine_night',
        'medicine_continues',

    ];
}
