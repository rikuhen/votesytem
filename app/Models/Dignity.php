<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dignity extends Model
{
    protected $fillable = [
        'name',
        'mode_vote',
        'state'
    ];


    public function lists()
    {
        return $this->belongsToMany(\App\Models\ListVote::class);
    }
}
