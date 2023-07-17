<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\ActivityLevel;
use App\Http\Resources\ActivityLevelResource;

class ActivityLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/activitylevel",
     *      operationId="getActivityLevelList",
     *      tags={"ActivityLevel"},
     *      summary="Get list of activities level",
     *      description="Returns list of activities level",
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

        $return = ActivityLevelResource::collection(ActivityLevel::get());

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
     * @param  \App\Models\ActivityLevel  $activitylevel
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/activitylevel/{id}",
     *      operationId="getOneActivityLevel",
     *      tags={"ActivityLevel"},
     *      summary="Get a activity level by id",
     *      description="Returns one activity level",
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
     *          description="ActivityLevel id",
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
    
    public function show(ApiRequest $request, ActivityLevel $activitylevel) {

        $return = new ActivityLevelResource($activitylevel);

        return response()->json($return, 200);
    }
}
