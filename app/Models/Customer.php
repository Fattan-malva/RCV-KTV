<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable; 

class Customer extends Model implements AuthenticatableContract
{
    use Authenticatable; 
    protected $table = 'customer'; 
    protected $fillable = [
        'username',
        'password',
        'role',
        'name',
        'login_type',

    ];
    public $timestamps = false;
}
