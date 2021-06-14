<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// testing





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// frontend

Route::get('/','frontendController@index');

Route::get('/blog/{url}', 'frontendController@blogDetails');

Route::get('/about',function(){
	return view('frontend.about');
});

Route::get('/contact',function(){
	return view('frontend.contact');
});


// Admin backend

Route::group(['middleware' => 'auth'],function(){

// User Dassboard
Route::get('/user/dashboard', 'BackendController@userDashboard');
Route::get('/user/createblog', 'BackendController@createBlog');
Route::post('/user/create', 'BlogController@create');
Route::get('/user/approvedBlogs', 'BlogController@approvedBlogs');

// User Awaiting Blogs
Route::get('/user/awaitingBlogs', 'BlogController@userAwaitingBlogs');
// User getAwaiting Blogs
Route::get('/user/getAwaitingUserBlogs', 'BlogController@getAwaitingUserBlogs');
Route::get('/user/deleteBlog{id}', 'BlogController@deleteBlog');
Route::get('/user/editBlog/{id}', 'BlogController@editBlogViewUser');
Route::post('/user/blogUpdate', 'BlogController@update');
Route::get('/user/getApprovedUserBlogs', 'BlogController@getApprovedUserBlogs');

// User profle 
Route::get('/user/userProfile',  'UserController@userProfile');

// Admin Dashboard
Route::group(['middleware' => 'checkrole'],function(){

	Route::get('/dashboard',function(){
		return view('backend.dashboard');
	});

	// Category crud
	Route::get('/categories','CategoryController@index');
	Route::post('/addCategory','CategoryController@create');
	Route::get('/getAllcategories','CategoryController@getAllcategories');
	Route::get('/getCategory{id}','CategoryController@getCategory');
	Route::post('/updateCategory','CategoryController@updateCategory');
	Route::get('/deleteCategory{id}', 'CategoryController@deleteCategory');

	// Tags crud
	Route::get('/tags', 'TagsController@index');
	Route::post('/addTag','TagsController@create');
	Route::get('/getAlltags','TagsController@getAlltags');
	Route::get('/getTag{id}','TagsController@getTag');
	Route::post('/updateTag','TagsController@updateTag');
	Route::get('/deleteTag{id}', 'TagsController@deleteTag');

	//  Blogs Crud
	Route::get('/blogs', 'BlogController@index');
	Route::get('/createblog', 'BlogController@createBlogView');
	Route::post('/blogCreate', 'BlogController@create');
	Route::get('/getAllBlogs', 'BlogController@getAllBlogs');
	Route::get('/editBlog/{id}', 'BlogController@editBlogView');
	Route::post('/blogUpdate', 'BlogController@update');
	Route::get('/deleteBlog{id}', 'BlogController@deleteBlog');

 // Awaiting approval for admin
	Route::get('/awaitingApproval', 'BlogController@awaitingApproval');
	Route::get('/getAwaitingApprovalBlog', 'BlogController@getAwaitingApprovalBlog');
	Route::get('/deleteBlog{id}', 'BlogController@deleteBlog');
	Route::get('/approveBlog{id}', 'BlogController@approveBlog');

	});
});



