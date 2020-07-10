<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class Voter extends User
{
    
    protected $table = "users";
    
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', '=', 'voter');
        });
    }
}
