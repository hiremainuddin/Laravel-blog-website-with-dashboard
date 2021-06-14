<?php

      namespace App\Http\Controllers;

      use Illuminate\Http\Request;
      use Auth;
      use App\Models\category;
      use App\Models\Tag;
      use App\Models\Blog;
      use Yajra\Datatables\Datatables;
      use Carbon\Carbon;
      use Response;
      use Str;

      class BlogController extends Controller
      {
          //Return blog listing view

        public function index()
        {
          return view('backend.blogs');
        }

          //Return create blog listing view

        public function createBlogView()
        {
          $categories = Category::all();
          $tags = Tag::all();

          return view('backend.createblog', compact('categories','tags'));
        }

          //Get All Blogs

        public function getAllBlogs()
        {
          $blogs = Blog::all();
          return Datatables::of($blogs)
          ->editColumn('user_id', function ($blog) {
            return '<span class="badge badge-success badge-pill">'.$blog->user->name."</span>";
          })
          ->editColumn('category_id', function ($blog) {
            return '<span class="badge badge-primary badge-pill">'.$blog->category->name."</span>";
          })
          ->editColumn('short_description', function ($blog) {
            return Str::words($blog->short_description, 10, '...');
          })
          ->editColumn('active', function ($blog) {
            if ($blog->active == "1") 
            {
              return "<span class='badge badge-success badge-pill'>Active</span>";
            }
            else
            {
             return "<span class='badge badge-dark badge-pill'>Awaiting Approval</span>";
           }

         })

          ->rawColumns(['user_id','category_id','active'])
          ->make(true);
        }

          // Blog Create
        public function create(Request $request)
        {   

          $user = Auth::user();
          $active =$request->active == 'on' ? 1 : 0;
          
          $this->validateBlog($request);

          $uploadedImage = $request->file('image');
          $imageWithExt  = $uploadedImage->getClientOriginalName();
          $imageName  = pathinfo($imageWithExt, PATHINFO_FILENAME);
          $imageExt = $uploadedImage->getClientOriginalExtension();
          $image = $imageName . time() . '.' .$imageExt; 
          $request->image->move(public_path('/images/blogsImages'), $image);

          $blog = Blog::create([

            'user_id' => $user->id,
            'category_id' => $request->category,
            'title' => $request->title,
            'url' => $request->url,
            'image' => $image,
            'image_alt' => $request->image_alt,
            'meta' => $request->meta,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'active' => $active,
          ]);

          $blog->tags()->attach($request->tags);

          return redirect()->back()->with('success','Successfully.');
        }

        public function validateBlog($request)
        {

          $request->validate([
           'title'    => 'required|min:3|max:255',
           'url'      => 'required|min:3|max:255|unique:blogs',
           'category' => 'required',
           'tags'     => 'required',
           'image'    => 'required|mimes:jpeg,png,jpg,gif,bmp|max:2000',
           'image_alt'=> 'required|min:3|max:255',
           'meta'     => 'required|min:3|max:255',
           'short_description' => 'required|min:3|max:500',
           'description'=> 'required|min:10',
         ]);

          return $request;
        }

          // Return editblog view
        public function editBlogView($id)
        {
          $blog = Blog::find($id);
          if($blog)
          {
            $categories = Category::all();
            $tags = Tag::all();

            return view('backend/editBlog', compact('categories','tags','blog'));
          }else
          {
            return abort(404);
          }
        }

          // Blog update
        public function update(Request $request) 
        {
          $blog = Blog::findOrFail($request->blog_id);

          $this->updateBlogValidation($request);

          $active = $request->active == "on" ? 1 : 0;
          
          $storeImage = $blog->image;

          if ($request->hasFile('image')) {

            $path  = '/images/blogsImages/';
            $image = $blog->image;
            $this->deleteImage($path, $image);


            $uploadedImage = $request->file('image');
            $imageWithExt  = $uploadedImage->getClientOriginalName();
            $imageName  = pathinfo($imageWithExt, PATHINFO_FILENAME);
            $imageExt = $uploadedImage->getClientOriginalExtension();
            $storeImage = $imageName . time() . '.' .$imageExt; 
            $request->image->move(public_path('/images/blogsImages'), $storeImage);

          }

          $blog->title = $request->title;
          $blog->url = $request->url;
          $blog->category_id = $request->category;
          $blog->image = $storeImage;
          $blog->image_alt = $request->image_alt;
          $blog->meta = $request->meta;
          $blog->short_description = $request->short_description;
          $blog->description = $request->description;
          $blog->active = $active;

          $blog->save();
          $blog->tags()->sync($request->tags);

          return redirect()->back()->with('success', 'Successfully');

        }

          //Validation for Updating
        public function updateBlogValidation($request)
        {
          if ($request->has('image')) 
          {

            $request->validate([
             'title'    => 'required|min:3|max:255',
             'url'      => 'required|min:3|max:255|unique:blogs,url,'.$request->blog_id,
             'category' => 'required',
             'tags'     => 'required',
             'image'    => 'required|mimes:jpeg,png,jpg,gif,bmp|max:2000',
             'image_alt'=> 'required|min:3|max:255',
             'meta'     => 'required|min:3|max:255',
             'short_description' => 'required|min:3|max:500',
             'description'=> 'required|min:10',
           ]);

          }else{

            $request->validate([
             'title'    => 'required|min:3|max:255',
             'url'      => 'required|min:3|max:255|unique:blogs,url,'.$request->blog_id,
             'category' => 'required',
             'tags'     => 'required',
             'image_alt'=> 'required|min:3|max:255',
             'meta'     => 'required|min:3|max:255',
             'short_description'=> 'required|min:3|max:500',
             'description'=> 'required|min:10',
           ]);

          }
        }

        // Delete Blog
        public function deleteBlog($id)
        {
          $blog = Blog::findOrFail($id);
          if ($blog) 
          {
            $path = '/images/blogsImages/';
            $image = $blog->image;
            $this->deleteImage($path, $image);

            $blog->delete();
            return 'Success';
          }else
          {
            return Response::json(['error' => 'Not Found'], 404);
          }
        }
        
        // Delete Old Image
        public function deleteImage($path, $image)
        {
          if (file_exists(public_path().$path.$image)) 
          {
           unlink(public_path().$path.$image);
         }

       }

      // Awaiting blog bade
       public function awaitingApproval()
       {
        return view('backend.awaitingBlog');
      }

        // Awaiting blog bade
      public function getAwaitingApprovalBlog()
      {
        $blogs = Blog::where('active', 0)->get();

        return Datatables::of($blogs)
        ->editColumn('user_id', function ($blog) {
          return '<span class="badge badge-success badge-pill">'.$blog->user->name."</span>";
        })
        ->editColumn('category_id', function ($blog) {
          return '<span class="badge badge-primary badge-pill">'.$blog->category->name."</span>";
        })
        ->editColumn('short_description', function ($blog) {
          return Str::words($blog->short_description, 10, '...');
        })
        ->editColumn('active', function ($blog) {
          if ($blog->active == "1") 
          {
            return "<span class='badge badge-success badge-pill'>Active</span>";
          }
          else
          {
           return "<span class='badge badge-dark badge-pill'>Awaiting Approval</span>";
         }

       })

        ->rawColumns(['user_id','category_id','active'])
        ->make(true);  
      }

      // Approve Blog for Admin
      public function approveBlog($id)
      {
        $blog = Blog::where('id', $id)->first();
        if ($blog) {
          $blog->active = 1;
          $blog->save();
          return "Success";
        }else
        {
          return Response::json(['error' =>'Not Found'], 404);
        }
      }

      // User Awaiting Blogs balde
      public function userAwaitingBlogs()
      {
        return view('userpanel.awaitingBlog');
      }  

       // User Awaiting Blogs balde
      public function getAwaitingUserBlogs()
      {

        $user_id = Auth::user()->id;
        $blogs = Blog::where('user_id', $user_id)->where('active', 0)->get();

        return Datatables::of($blogs)
        ->editColumn('user_id', function ($blog) {
          return '<span class="badge badge-success badge-pill">'.$blog->user->name."</span>";
        })
        ->editColumn('category_id', function ($blog) {
          return '<span class="badge badge-primary badge-pill">'.$blog->category->name."</span>";
        })
        ->editColumn('short_description', function ($blog) {
          return Str::words($blog->short_description, 10, '...');
        })
        ->editColumn('active', function ($blog) {
          if ($blog->active == "1") 
          {
            return "<span class='badge badge-success badge-pill'>Active</span>";
          }
          else
          {
           return "<span class='badge badge-dark badge-pill'>Awaiting Approval</span>";
         }

       })

        ->rawColumns(['user_id','category_id','active'])
        ->make(true);  
      }

        // Return edit blog view for user
      public function editBlogViewUser($id)
      {
        $blog = Blog::find($id);
        if($blog && $blog->user_id == Auth::user()->id)
        {
          $categories = Category::all();
          $tags = Tag::all();
          
          return view('userpanel/editBlog', compact('categories','tags','blog'));
        }else
        {
          return abort(404);
        }
      }

     // User Approved Blogs
      public function approvedBlogs()
      {
        return view('userpanel.approvedBlogs');
      }

      public function getApprovedUserBlogs()
      {


        $user_id = Auth::user()->id;
        $blogs = Blog::where('user_id', $user_id)->where('active', 1)->get();

        return Datatables::of($blogs)
        ->editColumn('user_id', function ($blog) {
          return '<span class="badge badge-success badge-pill">'.$blog->user->name."</span>";
        })
        ->editColumn('category_id', function ($blog) {
          return '<span class="badge badge-primary badge-pill">'.$blog->category->name."</span>";
        })
        ->editColumn('short_description', function ($blog) {
          return Str::words($blog->short_description, 10, '...');
        })
        ->editColumn('active', function ($blog) {
          if ($blog->active == "1") 
          {
            return "<span class='badge badge-success badge-pill'>Active</span>";
          }
          else
          {
           return "<span class='badge badge-dark badge-pill'>Awaiting Approval</span>";
         }

       })

        ->rawColumns(['user_id','category_id','active'])
        ->make(true);  
      }

    }
