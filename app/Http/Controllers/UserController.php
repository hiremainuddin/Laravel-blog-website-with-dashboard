<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //User Profile View 
    public function userProfile()
    {
    	$user = Auth::user();

    	return view('userpanel.userProfile', compact('user'));
    }
}
