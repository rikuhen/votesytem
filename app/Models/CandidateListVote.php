<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateListVote extends Model
{
    protected $fillable = [
        'list_id',
        'name',
        'position'
    ];


    public function list()
    {
        return $this->belongsTo(\App\Models\ListVote::class,'list_id');
    }
}
