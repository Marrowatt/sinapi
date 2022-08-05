<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\AG;
use App\Http\Resources\AGResource;

class AGController extends Controller
{
    /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/ag",
     *      operationId="getAGList",
     *      tags={"AG"},
     *      summary="Get list of fatty acids",
     *      description="Returns list of fatty acids",
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

        $return = AGResource::collection(AG::with('food')->get());

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
     * @param  \App\Models\AG  $ag
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/ag/{id}",
     *      operationId="getOneAG",
     *      tags={"AG"},
     *      summary="Get a fatty acid by id",
     *      description="Returns one fatty acid",
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
    
    public function show(ApiRequest $request, AG $ag) {

        $return = new AGResource($ag->load('food.category'));

        return response()->json($return, 200);
    }
}
