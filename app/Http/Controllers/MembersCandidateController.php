<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MembersCandidateRequest;
use App\Models\MembersCandidate;
use App\Http\Resources\MembersCandidateResource;
use Exception;
use DB;

class MembersCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($candidateId)
    {
        $members = MembersCandidate::where('candidate_id', $candidateId)->get();
        return MembersCandidateResource::collection($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MembersCandidateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembersCandidateRequest $request, $candidateId)
    {
        DB::beginTransaction();

        try {
            $member = new MembersCandidate();
            $member->fill($request->all());
            $member->saveOrFail();
            DB::commit();
            return new MembersCandidateResource($member);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar el miembro, intente nuevamente', 'details' =>  $e->getMessage()], 411);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($candidateId, $id)
    {
        $member = MembersCandidate::where('candidate_id', $candidateId)->whereId($id)->first();
        if ($member) {
            return new MembersCandidateResource($member);
        }
        return response()->json(['message' => 'Candidato o lista no encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MembersCandidateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MembersCandidateRequest $request, $candidateId, $id)
    {
        DB::beginTransaction();

        try {
            $member = MembersCandidate::where('candidate_id', $candidateId)->whereId($id)->first();
            if ($member) {
                $member->fill($request->all());
                $member->saveOrFail();
                DB::commit();
                return new MembersCandidateResource($$member);
            }
            return response()->json(['message' => 'Miembro de la lista no encontrado'], 404);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el miembro de la lista, intente nuevamente'], 411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($candidateId, $id)
    {
        $member = MembersCandidate::where('candidate_id', $candidateId)->whereId($id)->first();
        if ($member) {
            $memberName =  $member->name;
            if ($member->delete())
                return response()->json(['message' => "Miembro {$memberName} eliminado  Correctamente"], 200);
        }
        return response()->json(['message' => 'Miembro no encontrado'], 404);
    }
}
