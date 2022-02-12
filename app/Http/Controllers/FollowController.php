<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;

class FollowController extends Controller
{
    public function followNofollow(Request $request)
    {
        $followerId = User::find(auth()->user()->id);
        $followingId = User::find($request->userId);
        $followerId->following()->toggle($followingId);

        return redirect()->back();
    }
}
