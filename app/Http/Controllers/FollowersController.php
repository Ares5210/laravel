<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(User $user)
    {
    	if($user->id === Auth::user()->id) {
    		return redirect('/');
    	}

    	if(!Auth::user()->is_followings($user->id)) {
    		Auth::user()->follow($user->id);
    	}

    	return back();
    }

    public function destroy(User $user)
    {
    	if($user->id === Auth::user()->id) {
    		return redirect('/');
    	}

    	if(Auth::user()->is_followings($user->id)) {
    		Auth::user()->unfollow($user->id);
    	}

    	return back();
    }
}
