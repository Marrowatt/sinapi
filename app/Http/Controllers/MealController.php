<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\MealStoreRequest;
use App\Http\Requests\MealUpdateRequest;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\Meal;
use App\Http\Resources\MealResource;

use App\Models\Food;
use App\Models\User;
use App\Models\MealFood;

class MealController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/meal/{id}",
     *      operationId="getOneMeal",
     *      tags={"Meal"},
     *      summary="Get a meal by id",
     *      description="Returns one meal",
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
     *          description="Meal id",
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
    
    public function show(ApiRequest $request, Meal $meal) {

        $return = new MealResource($meal->load('meal_food'));

        return response()->json($return, 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MealStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/meal",
     *      operationId="addMeal",
     *      tags={"Meal"},
     *      summary="Add a meal",
     *      description="Add a meal",
     *      @OA\Parameter(
     *          name="api_token",
     *          description="Api Token",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="user", type="integer"),
     *              @OA\Property(property="hour", type="string"),
     *              @OA\Property(property="nickname", type="string"),
     *              @OA\Property(property="foods", type="array", 
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="food", type="string"),
     *                      @OA\Property(property="quantity", type="integer"),
     *                  )
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     *     )
     */

    public function store (MealStoreRequest $request) {

        $user = User::find($request->user);

        $meal_data = [
            'nutritional_guidance_id' => $user->nutritional_guidance->id,
            'hour' => $request->hour,
            'nickname' => $request->nickname,
        ];

        $meal = Meal::create($meal_data);

        foreach ($request->foods as $f) {

            $food = Food::where("name", $f['food'])->first();

            MealFood::create([
                'meal_id' => $meal->id,
                'food_id' => $food->id,
                'quantity' => $f['quantity']
            ]);
        }

        return response()->json(new MealResource($meal->load('meal_food')), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MealUpdateRequest  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Patch(
     *      path="/api/meal/{id}",
     *      operationId="updatesMeal",
     *      tags={"Meal"},
     *      summary="Updates a Meal",
     *      description="Updates the values of a meal",
     *      @OA\Parameter(
     *          name="api_token",
     *          description="Api Token",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="user", type="integer"),
     *              @OA\Property(property="hour", type="string"),
     *              @OA\Property(property="nickname", type="string"),
     *              @OA\Property(property="foods", type="array", 
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="food", type="string"),
     *                      @OA\Property(property="quantity", type="integer"),
     *                  )
     *              ),
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Meal id",
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
     *      )
     *     )
     */
    
    public function update(MealUpdateRequest $request, Meal $meal) {

        $meal_data = array_filter($request->only([ 'hour', 'nickname' ]));

        $meal->update($meal_data);

        foreach ($request->foods as $f) {

            $food = Food::where("name", $f['food'])->first();

            $mealfood = MealFood::where('meal_id', $meal->id)->first();

            $mealfood->update([
                'food_id' => $food->id,
                'quantity' => $f['quantity']
            ]);
        }
        
        return response()->json(new MealResource($meal->load('meal_food')), 200);
    }

    /**
     * Update the status from a specified resource in storage.
     *
     * @param  \Illuminate\Http\ApiRequest  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Patch(
     *      path="/api/meal/{id}/changestatus",
     *      operationId="updatesMealStatus",
     *      tags={"Meal"},
     *      summary="Updates the status from an Meal",
     *      description="Updates the status from an meal",
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
     *          name="id",
     *          description="Meal id",
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
    
    public function changestatus (ApiRequest $request, Meal $meal) {

        $meal->update([
            "active" => $meal->active ? 0 : 1
        ]);

        return response()->json(new MealResource($meal->load('meal_food')), 200);
    }

    /**
     * Update the notifiable status from a specified resource in storage.
     *
     * @param  \Illuminate\Http\ApiRequest  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Patch(
     *      path="/api/meal/{id}/notify",
     *      operationId="updatesMealNotify",
     *      tags={"Meal"},
     *      summary="Updates the notifiable from an Meal",
     *      description="Updates the notifiable from an meal",
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
     *          name="id",
     *          description="Meal id",
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
    
    public function notify (ApiRequest $request, Meal $meal) {

        $meal->update([
            "notifiable" => $meal->notifiable ? 0 : 1
        ]);

        return response()->json(new MealResource($meal->load('meal_food')), 200);
    }

}
