<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\VoteResource;
use App\Models\User;
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

    public function getTotalVoters(Request $request)
    {
        $voters = User::whereRole('voter')->count();
        return response()->json(['data' =>  $voters], 200);
    }

    public function getTotalVotersHaveVoted(Request $request)
    {
        $voters = User::whereRole('voter')->whereEnabled(0)->count();
        return response()->json(['data' =>  $voters], 200);
    }
    
    public function getTotalVotersHaveNotVoted(Request $request)
    {
        $voters = User::whereRole('voter')->whereEnabled(1)->count();
        return response()->json(['data' =>  $voters], 200);
    }
}
