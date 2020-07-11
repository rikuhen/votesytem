<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use DB;
use Exception;
use App\Events\VoteRegistered;
use App\Http\Requests\VoteRequest;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\VoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoteRequest $request)
    {
        DB::beginTransaction();

        try {
            $vote = new Vote();
            $vote->fill($request->all());
            $vote->point = config('votes.points');
            $vote->saveOrFail();
            DB::commit();
            event(new VoteRegistered());
            return response()->json(['message' => 'Gracias por registrar tu voto, serás redirigido automaticamente fuera del sistema'],200);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al registrar el voto, intente nuevamente', 'details'=>  $e->getMessage()],411);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
