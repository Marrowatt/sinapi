<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\CMVCol;
use App\Http\Resources\CMVColResource;

class CMVColController extends Controller
{
    /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/cmvcol",
     *      operationId="getCMVColList",
     *      tags={"CMVCol"},
     *      summary="Get list of cmvcol",
     *      description="Returns list of cmvcol",
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

        $return = CMVColResource::collection(CMVCol::with('food')->get());

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
     * @param  \App\Models\CMVCol  $cmvcol
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/cmvcol/{id}",
     *      operationId="getOneCMVCol",
     *      tags={"CMVCol"},
     *      summary="Get a CMVCol by id",
     *      description="Returns one cmvcol",
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
     *          description="CMVCol id",
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
    
    public function show(ApiRequest $request, CMVCol $cmvcol) {

        $return = new CMVColResource($cmvcol->load('food.category'));

        return response()->json($return, 200);
    }
}
