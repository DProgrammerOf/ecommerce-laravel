<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property string $password
 *
 * @method where(string $string, string $value)
 * @method find(int $value)
 */
class User extends Model
{
    public $table = 'users';
    public $timestamps = true;
}
