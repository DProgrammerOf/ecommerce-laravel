<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 *
 *
 * @property string $password
 *
 * @method where(string $string, string $value)
 * @method find(int $value)
 */
class User extends Authenticatable
{
    use HasApiTokens;

    public $table = 'users';
    public $timestamps = true;


}
