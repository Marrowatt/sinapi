<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use Illuminate\Support\Facades\Cache;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\Food;
use App\Http\Resources\FoodResource;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/food",
     *      operationId="getFoodList",
     *      tags={"Food"},
     *      summary="Get list of foods",
     *      description="Returns list of foods",
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
     *          name="contains",
     *          description="",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string", example=""),
     *          ),
     *          style="deepObject"
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

        $foods = Cache::rememberForever('foods', function () {
            return FoodResource::collection(Food::get());
        });
        
        return response()->json($foods, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/food/{id}",
     *      operationId="getFoodById",
     *      tags={"Food"},
     *      summary="Get a food by id",
     *      description="Returns one food",
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
     *          description="Food id",
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
    
    public function show(ApiRequest $request, Food $food) {

        $return = new FoodResource($food->load('category', 'ag', 'aminoacid', 'cmvcol'));

        return response()->json($return, 200);
    }

    public function getFood () {

        $foods = FoodResource::collection(Food::get());

        return response()->json($foods, 200);
    }

    public function getOneFood ($id) {

        $food = Food::with('category', 'ag', 'aminoacid', 'cmvcol')->find($id);

        return response()->json($food, 200);
    }
}
