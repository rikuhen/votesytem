<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable
{
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable =  [
        'num_identification',
        'name',
        'email',
        'password', // password
        'enabled',
    ];
}
