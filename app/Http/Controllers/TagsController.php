<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Tag;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Response;

class TagsController extends Controller
{
    //Return  view for catgory
      public function index()
      {
        return view('backend.tags');
      }


    // Getting all the Tags using Datatabels
      public function getAlltags()
      {
        $tags = Tag::all();
        return Datatables::of($tags)
        ->editColumn('created_at', function ($tags) {
          return $tags->created_at ? with(new Carbon($tags->created_at))->format('d-M-Y') : '';
        })
        ->editColumn('updated_at', function ($tags) {
          return $tags->updated_at ? with(new Carbon($tags->updated_at))->format('d-M-Y') : '';
        })
        ->make(true);
      }


    // add Tag
      public function create(Request $request)
      {
        $request->validate([
         'tag_name' => 'Required|min:3|max:255',
       ]);

        $slug = Str::slug($request->tag_name);
        
        $category = Tag::create([
         'name' => $request->tag_name,
         'slug' => $slug,
       ]);
        return "Success";
      }

       // Get Tags
      public function getTag($id)
      {
       
       $tags = Tag::find($id);

       if ($tags) {

         return $tags;

       }else
       {
         return Response::json(['error' => 'Not Found'], 404);
       }

      }
     

     // Update Tags
     public function updateTag(Request $request)
     {

      $request->validate([
        'edit_tag_name' => 'Required|min:3|max:255',
      ],[
         'edit_tag_name.required' => 'The tag field is required.',
         'edit_tag_name.min' => 'The tag name should be min 3 characters.',
         'edit_tag_name.max' => 'The tag name may be not greater then 255 characters.',
      ]);

      $tag = Tag::find($request->tag_id);
      $tag->name = $request->edit_tag_name;
      $tag->slug = Str::slug($request->edit_tag_name);
      $tag->save();

      return "Success";

     }

     public function deleteTag($id)
     {
      $tag = Tag::find($id);

      if ($tag) 
      {
        $tag->delete();
        return "Success";
      }else
      {
        return Response::json(['error' => 'Not Found', 404]);
      }
     }
}
