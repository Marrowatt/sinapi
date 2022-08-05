<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\Aminoacid;
use App\Http\Resources\AminoacidResource;

class AminoacidController extends Controller
{
    /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/aminoacid",
     *      operationId="getAminoacidList",
     *      tags={"Aminoacid"},
     *      summary="Get list of aminoacids",
     *      description="Returns list of aminoacids",
     *      @OA\Parameter(
     *          name="api_token",
     *          description="API Token",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="paginate",
     *          description="Number of customers per page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     *     )
     */
    public function index (ApiRequest $request) {

        $return = AminoacidResource::collection(Aminoacid::with('food')->get());

        // if($request->exists("paginate")){
        //     if($request->paginate != null || $request->paginate != ''){
        //        $return = $return->paginate($request->paginate);
        //     }
        // }

        return response()->json($return, 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aminoacid  $aminoacid
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/aminoacid/{id}",
     *      operationId="getOneAminoacid",
     *      tags={"Aminoacid"},
     *      summary="Get a aminoacid by id",
     *      description="Returns one aminoacid",
     *      @OA\Parameter(
     *          name="api_token",
     *          description="API Token",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="AG id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     *     )
     */
    
    public function show(ApiRequest $request, Aminoacid $aminoacid) {

        $return = new AminoacidResource($aminoacid->load('food.category'));

        return response()->json($return, 200);
    }
}
