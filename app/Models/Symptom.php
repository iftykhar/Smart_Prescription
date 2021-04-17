<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(mixed $id)
 * @property mixed id
 */
class Symptom extends Model
{
    use HasFactory;
    protected $fillable = [
        'symptoms_name',
    ];
}
