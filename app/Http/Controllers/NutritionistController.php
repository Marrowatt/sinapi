<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActivityLevel;
use App\Models\Gender;
use App\Models\Formula;
use App\Models\User;
use App\Models\NutritionalGuidance;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class NutritionistController extends Controller
{   
    public function index()
    {
        return view('nutritionist.home');
    }

    public function profile () {
        $activities = ActivityLevel::select('id', 'name')->get();
        $genders = Gender::select('id', 'name')->get();
        $formulas = Formula::select('id', 'name')->get();

        return view('nutritionist.profile.view', compact('activities', 'genders', 'formulas'));
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

        return redirect()->route('nutritionist.profile');
    }

    public function profile_password_update (Request $request, User $user) {

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('nutritionist.profile');
    }
    
    public function patients () {
        return view('nutritionist.patients');
    }
    
    public function getPatients (Request $request) {

        $patients_guidance = auth()->user()->patients_guidance;

        $return = array();

        foreach ($patients_guidance as $pg) {
            array_push($return, $pg->patient);
        }
        
        return response()->json(UserResource::collection($return)->paginate(15), 200);
    }

    /**
     * @OA\Patch(
     *      path="/api/nutritionist/{id}/unlink/{user}",
     *      operationId="unlinkPatient",
     *      tags={"Nutritionist"},
     *      summary="Unlink a patient from a nutritionist",
     *      description="Unlink a patient from a nutritionist",
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
     *          description="Nutritionist id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user",
     *          description="Patient id",
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
    public function unlinkPatient (Request $request, User $nutritionist, User $user) {

        $guidance = NutritionalGuidance::where('nutritionist_id', $nutritionist->id)
                                       ->where('user_id', $user->id)->firstOrFail();

        $guidance->update([
            'nutritionist_id' => null
        ]);

        return response()->json(['msg' => 'Paciente desvinculado'], 200);
    }
    
    /**
     * @OA\Patch(
     *      path="/api/nutritionist/{id}/link/{user}",
     *      operationId="linkPatient",
     *      tags={"Nutritionist"},
     *      summary="Link a patient from a nutritionist",
     *      description="Link a patient from a nutritionist",
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
     *          description="Nutritionist id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user",
     *          description="Patient id",
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
    public function linkPatient (Request $request, User $nutritionist, User $user) {

        $guidance = NutritionalGuidance::where('nutritionist_id', null)
                                       ->where('user_id', $user->id)->firstOrFail();

        $guidance->update([
            'nutritionist_id' => $nutritionist->id
        ]);

        return response()->json(['msg' => 'Paciente vinculado'], 200);
    }
}
