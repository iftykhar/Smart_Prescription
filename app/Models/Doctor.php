<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static find($id)
 * @method static findOrfail(mixed $id)
 * @method static create(array $attribute)
 */
class Doctor extends Model
{
    //use HasFactory;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'degree',
        'phone',
        'email',
        'address',
        'hospital_id'

    ];
    /**
     * @var mixed
     */
    private $id;
    /**
     * @var mixed
     */

}
