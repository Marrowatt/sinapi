<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

use LaravelLegends\EloquentFilter\Filter;

use App\Models\User;
use App\Http\Resources\UserResource;

use App\Models\Gender;
use App\Models\ActivityLevel;
use App\Models\UserType;

use Illuminate\Support\Str;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     **
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/user",
     *      operationId="getUserList",
     *      tags={"User"},
     *      summary="Get list of users",
     *      description="Returns list of users",
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

        $return = UserResource::collection(User::with('activity_level')->get());

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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/user/{id}",
     *      operationId="getOneUser",
     *      tags={"User"},
     *      summary="Get a user by id",
     *      description="Returns one user",
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
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     *     )
     */
    
    public function show(ApiRequest $request, User $user) {

        $return = new UserResource($user->load('activity_level'));

        return response()->json($return, 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/api/user",
     *      operationId="addUser",
     *      tags={"User"},
     *      summary="Add a user",
     *      description="Add a user",
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
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="birthday", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="weight", type="integer"),
     *              @OA\Property(property="height", type="integer"),
     *              @OA\Property(property="user_type", type="string"),
     *              @OA\Property(property="activity_level", type="string"),
     *              @OA\Property(property="gender", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     *     )
     */

    public function store (UserStoreRequest $request) {

        $gender = Gender::where('name', $request->gender)->first();
        $activity_level = ActivityLevel::where('name', $request->activity_level)->first();
        $user_type = UserType::where('name', $request->user_type)->first();

        $user_data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'weight' => $request->weight,
            'height' => $request->height,
            'user_type_id' => $user_type->id,
            'activity_level_id' => $activity_level->id,
            'gender_id' => $gender->id,
            'api_token' => Str::random(90),
        ];

        $user = User::create($user_data);

        return response()->json(new UserResource($user->load('activity_level')), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Patch(
     *      path="/api/user/{id}",
     *      operationId="updatesUser",
     *      tags={"User"},
     *      summary="Updates a User",
     *      description="Updates the values of a user",
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
     *          @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *              type="object",
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="birthday", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="weight", type="integer"),
     *              @OA\Property(property="height", type="integer"),
     *              @OA\Property(property="user_type", type="string"),
     *              @OA\Property(property="activity_level", type="string"),
     *              @OA\Property(property="gender", type="string"),
     *             )
     *         )
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
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     *     )
     */
    
    public function update(UserUpdateRequest $request, User $user) {

        $user_data = array_filter($request->only([
                'name', 'email', 'birthday', 'phone', 'weight', 'height',
            ]));

        $user->update($user_data);

        if($request->has('gender')) {
            $user->gender_id = Gender::where('name', $request->gender)->first()->id;
        }

        if($request->has('activity_level')) {
            $user->activity_level_id = ActivityLevel::where('name', $request->activity_level)->first()->id;
        }

        if($request->has('user_type')) {
            $user->user_type_id = UserType::where('name', $request->user_type)->first()->id;
        }

        $user->save();
        
        return response()->json(new UserResource($user->load('activity_level')), 200);
    }

    /**
     * Update the status from a specified resource in storage.
     *
     * @param  \Illuminate\Http\ApiRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Patch(
     *      path="/api/user/{id}/changestatus",
     *      operationId="updatesUserStatus",
     *      tags={"User"},
     *      summary="Updates the status from an User",
     *      description="Updates the status from an user",
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
     *          description="User id",
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
    
    public function changestatus (ApiRequest $request, User $user) {

        $user->update([
            "active" => $user->active ? 0 : 1
        ]);

        return response()->json(new UserResource($user->load('activity_level')), 200);
    }
}
