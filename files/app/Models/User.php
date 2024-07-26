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
class User extends Authenticatable
{
    use HasApiTokens;

    public $table = 'users';
    public $timestamps = true;

    /*
     * columns to fill by create
     */
    protected $fillable = [
        'username', 'password', 'full_name', 'email', 'cpf', 'date_of_birth', 'reference'
    ];


}
