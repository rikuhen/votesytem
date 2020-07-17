<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use PDF;

class PrintReporterController extends Controller
{
    public function getTotalVoters(Request $request)
    {
        set_time_limit(300); // Extends to 5 minutes.
        $date = date('Y-m-d');
        $voters = User::where('role', 'voter')->orderBy('name')->get();
        $users = User::where('role','supervisor')->whereEnabled(1)->get();
        $pdf = PDF::loadView('reporters.voters',compact('voters','users'));
        return $pdf->stream('reporte-votantes-'.$date.'.pdf');
    }

    public function getTotalResults(Request $request)
    {
        set_time_limit(300); // Extends to 5 minutes.
        $date = date('Y-m-d');

        $ranking = Vote::selectRaw('candidates.name, sum(votes.`point` )  point')
        ->rightJoin('candidates', 'votes.candidate_id', '=', 'candidates.id')
        ->groupByRaw('candidates.name')
        ->orderBy('point', 'desc')
        ->get();

        $totalVoters = User::whereRole('voter')->count();

        $haveVoted = User::whereRole('voter')->whereEnabled(0)->count();

        $haveNotVoted = User::whereRole('voter')->whereEnabled(1)->count();

        $users = User::where('role','supervisor')->whereEnabled(1)->get();

        $pdf = PDF::loadView('reporters.results',compact('ranking','totalVoters','haveVoted','haveNotVoted','users'));
        return $pdf->stream('reporte-resultados-'.$date.'.pdf');
    }
}
