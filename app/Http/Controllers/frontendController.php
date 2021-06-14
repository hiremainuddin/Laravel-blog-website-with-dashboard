<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;

class frontendController extends Controller
{
    //Home page
    public function index()
    {
    	$blogs = Blog::where('active', 1)->orderBy('id', 'desc')->paginate(3);


    	return view('frontend.blogs', compact('blogs'));
    }

    // Bolg details
    public function blogDetails($url)
    {
    	$blog = Blog::where('url', $url)->first();
    	
        return view('frontend.blog_detail', compact('blog'));
        
    }
}
