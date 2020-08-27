<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DignityListVotes extends Model
{
    protected $fillable = [
        'dignity_id',
        'list_id'
    ];
}
