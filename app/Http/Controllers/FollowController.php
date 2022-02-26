<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;

class FollowController extends Controller
{
    public function show(Request $request)
    {
        return view('users.show')->with('user', $request);
    }

    public function follow_do(Request $request)
    {
        $follow_user = User::find(auth()->user()->id);
        // return $follow_user;
        if ($follow_user->id != $request->id) {
            $follow_user->follows()->attach($request->id);
            return $follow_user->isFollowing($request->id);
        }
    }

    public function follow_check(Request $request)
    {
        $check_user = User::find(auth()->user()->id);
        return $check_user->isFollowing($request->id);
    }
}
