<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Tag;
use App\Models\Blog;

class BackendController extends Controller
{
    //User Dashboard 
	public function userDashboard()
	{
		return view('userpanel.dashboard');
	}

    // User Create Blog
	public function createBlog()
	{
		$categories = Category::all();
		$tags = Tag::all();
		return view('userpanel.createblog', compact('categories','tags') );
	}
}
