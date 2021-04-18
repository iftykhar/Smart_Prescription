<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(mixed $id)
 * @property mixed id
 */
class Test_Suggestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'symptom_name',
        'tests_name',
        'ts_score',
    ];
}
