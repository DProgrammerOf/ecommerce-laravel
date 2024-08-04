<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 *
 *
 * @property int $id
 * @property string $password
 *
 * @method where(string $string, string $value)
 * @method find(int $value)
 */
class Admin extends Authenticatable
{
    use HasApiTokens;

    public $table = 'admins';
    public $timestamps = true;
}
