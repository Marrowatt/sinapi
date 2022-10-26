<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActivityLevel;
use App\Models\Gender;

use App\Models\User;
use App\Http\Requests\RegularUpdateRequest;

use App\Http\Requests\ApiRequest;

class RegularController extends Controller
{
    public function index()
    {
        return view('regular.home');
    }

    public function profile () {
        $activities = ActivityLevel::select('id', 'name')->get();
        $genders = Gender::select('id', 'name')->get();

        return view('regular.profile.view', compact('activities', 'genders'));
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

        $user->save();

        return redirect()->route('regular.profile');
    }

    
    public function profile_password_update () {
        
    }
}
