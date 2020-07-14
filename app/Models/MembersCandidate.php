<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersCandidate extends Model
{
    protected $fillable = [
        'candidate_id',
        'name',
        'position'
    ];


    public function candidate()
    {
        return $this->belongsTo(\App\Models\Candidate::class,'candidate_id');
    }
}
