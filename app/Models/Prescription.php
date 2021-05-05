<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @method static create(array $attribute)
 * @method static findOrFail(mixed $id)
 */
class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_age',
        'patient_gender',
        'patient_weight',
        'patient_bp_high',
        'patient_bp_low',
        'status'
    ];
}
