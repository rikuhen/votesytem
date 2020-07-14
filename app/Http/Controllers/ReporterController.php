<?php

namespace App\Http\Controllers;

use App\Http\Resources\VoteResource;
use Illuminate\Http\Request;
use App\Models\Vote;


class ReporterController extends Controller
{
    public function getTotalVotes(Request $request)
    {
        $ranking = Vote::selectRaw('candidates.name, sum(votes.`point` )  point')
            ->rightJoin('candidates', 'votes.candidate_id', '=', 'candidates.id')
            ->groupByRaw('candidates.name')
            ->orderBy('point', 'desc')
            ->get();

        return VoteResource::collection($ranking);
    }
}
