<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActivityLevel;
use App\Models\Gender;
use App\Models\Formula;
use App\Models\User;

use App\Http\Requests\RegularUpdateRequest;

use App\Http\Requests\ApiRequest;

use App\Http\Resources\MealResource;

class RegularController extends Controller
{
    public function index()
    {
        return view('regular.home');
    }

    public function profile () {
        $activities = ActivityLevel::select('id', 'name')->get();
        $genders = Gender::select('id', 'name')->get();
        $formulas = Formula::select('id', 'name')->get();

        return view('regular.profile.view', compact('activities', 'genders', 'formulas'));
    }

    public function profile_update (Request $request, User $user) {
        
        $user_data = array_filter($request->only([
            'name', 'email', 'birthday', 'phone',
        ]));

        $user->update($user_data);

        if($request->has('height')) {
            $user->height = $request->height * 100;
        }

        if($request->has('weight')) {
            $user->weight = $request->weight * 100;
        }

        if($request->has('gender_id')) {
            $user->gender_id = Gender::find($request->gender_id)->id;
        }

        if($request->has('activity_level_id')) {
            $user->activity_level_id = ActivityLevel::find($request->activity_level_id)->id;
        }

        if($request->has('formula_id')) {
            $user->formula_id = Formula::find($request->formula_id)->id;
        }

        $user->save();

        return redirect()->route('regular.profile');
    }

    
    public function profile_password_update () {
        
    }

    
    /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/regular/{id}/meal",
     *      operationId="getUserMealList",
     *      tags={"RegularUser"},
     *      summary="Get list of meals from an user",
     *      description="Returns list of of meals from an user",
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
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
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
    
     public function regularMeals (ApiRequest $request, User $user) {

        $return = MealResource::collection($user->nutritional_guidance->meals->where('active', 1));

        return response()->json($return, 200);
    }
}
