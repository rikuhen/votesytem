<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListVote extends Model
{
    protected $fillable = [
        'name',
        'description',
        'img_path',
        'enabled',
    ];


    public function candidates()
    {
        return $this->hasMany(\App\Models\CandidateListVote::class,'candidate_id');
    }
}
