<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Resources\CandidateResource;
use DB;
use Exception;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Candidate::all();
        return CandidateResource::collection($customers);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        DB::beginTransaction();

        try {
            $candidate = new Candidate();
            $candidate->fill($request->all());
            $candidate->saveOrFail();
            DB::commit();
            return new CandidateResource($candidate);
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
        $candidate = Candidate::find($id);
        if ($candidate) {
            return new CandidateResource($candidate);
        }
        return response()->json(['message' => 'Candidato o lista no encontrada'], 404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $candidate = Candidate::find($id);
            if ($candidate) {
                $candidate->fill($request->all());
                $candidate->saveOrFail();
                DB::commit();
                return new CandidateResource($candidate);
            }
            return response()->json(['message' => 'Candidato o lista no encontrada'], 404); 
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el candidato, intente nuevamente'],411);
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
        $candidate = Candidate::find($id);


        if ($candidate->enabled) return response()->json(['message' => "Candidato {$candidate->name} no puede ser eliminado por que esta activo"],200);

        if ($candidate) {
            $candidateName =  $candidate->name;
            if($candidate->delete())
                return response()->json(['message' => "Candidato {$candidateName} eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Candidato no encontrado'], 404);

    }
}
