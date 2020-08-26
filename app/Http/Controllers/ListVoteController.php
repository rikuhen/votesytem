<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListVoteRequest;
use App\Models\ListVote;
use Illuminate\Http\Request;
use App\Http\Resources\ListVoteResource;
use DB;
use Exception;

class ListVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = ListVote::with('candidates')->where('enabled','1')
        ->orderBy('name','asc')
        ->get();
        return ListVoteResource::collection($lists);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListVoteRequest $request)
    {
        DB::beginTransaction();

        try {
            $listVote = new ListVote();
            $listVote->fill($request->all());
            $listVote->saveOrFail();
            DB::commit();
            return new ListVoteResource($listVote);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar la lista a votar, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $listVote = ListVote::find($id);
        if ($listVote) {
            return new ListVoteResource($listVote);
        }
        return response()->json(['message' => 'lista no encontrada'], 404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListVoteRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $listVote = ListVote::find($id);
            if ($listVote) {
                $listVote->fill($request->all());
                $listVote->saveOrFail();
                DB::commit();
                return new ListVoteResource($listVote);
            }
            return response()->json(['message' => 'lista no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar la lista, intente nuevamente'],411);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listVote = ListVote::find($id);


        if ($listVote->enabled) return response()->json(['message' => "Lista {$listVote->name} no puede ser eliminada por que esta activo"],200);

        if ($listVote) {
            $candidateName =  $listVote->name;
            if($listVote->delete())
                return response()->json(['message' => "Lista {$candidateName} eliminada  Correctamente"],200);
        }
        return response()->json(['message' => 'Lista no encontrado'], 404);

    }
}
