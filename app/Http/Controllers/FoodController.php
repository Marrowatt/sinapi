<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ApiRequest;

use App\Models\Food;

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
     *      tags={"Foods"},
     *      summary="Get list of foods",
     *      description="Returns list of foods",
     *      @OA\Parameter(
     *          name="api_token",
     *          description="Api Token",
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

        $foods = Food::get();

        return response()->json($foods, 200);
    }


}
