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
        return $this->hasMany(\App\Models\CandidateListVote::class,'list_id');
    }

    public function dignities()
    {
        return $this->belongsToMany(\App\Models\CandidateListVote::class);
    }
}
