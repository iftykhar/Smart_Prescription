<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(Test $test)
 * @property mixed id
 */
class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'tests_name',
    ];
}
