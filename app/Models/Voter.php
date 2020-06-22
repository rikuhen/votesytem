<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable =  [
        'num_identification',
        'name',
        'lastname',
        'email',
        'password', // password
        'enabled',
    ];
}
