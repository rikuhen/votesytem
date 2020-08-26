<?php

namespace App\Http\Controllers;

use App\Http\Requests\DignityRequest;
use App\Http\Requests\VoteRequest;
use App\Http\Resources\DignityResource;
use Illuminate\Http\Request;
use App\Models\Dignity;
use Exception;
use DB;


class DignityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dignities = Dignity::all();
        return DignityResource::collection($dignities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DignityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DignityRequest $request)
    {
        DB::beginTransaction();

        try {
            $dignity = new Dignity();
            $dignity->fill($request->all());
            $dignity->saveOrFail();
            DB::commit();
            return new DignityResource($dignity);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al ingresar la dignidad a elegir, intente nuevamente', 'details'=>  $e->getMessage()],411);
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
        $dignity = Dignity::find($id);
        if ($dignity) {
            return new DignityResource($dignity);
        }
        return response()->json(['message' => 'Dignidad a elegir no encontrada'], 404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\DignityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DignityRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $dignity = Dignity::find($id);
            if ($dignity) {
                $dignity->fill($request->all());
                $dignity->saveOrFail();
                DB::commit();
                return new DignityResource($dignity);
            }
            return response()->json(['message' => 'Dignidad a elegir no encontrada'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Hubo un error al actualizar el la dignidad, intente nuevamente', 'details' => $e->getMessage()],411);
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
        $dignity = Dignity::find($id);


        if ($dignity->state) return response()->json(['message' => "Dignidad {$dignity->name} no puede ser eliminado por que esta activo"],200);

        if ($dignity) {
            $dignityName =  $dignity->name;
            if($dignity->delete())
                return response()->json(['message' => "Dignidad {$dignityName} eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Dignidad no encontrado'], 404);

    }
}
