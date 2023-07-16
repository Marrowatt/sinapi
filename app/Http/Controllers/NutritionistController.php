<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActivityLevel;
use App\Models\Gender;
use App\Models\Formula;
use App\Models\User;
use App\Http\Resources\UserResource;

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
}
