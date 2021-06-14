<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;
    use App\Models\Category;
    use Yajra\Datatables\Datatables;
    use Carbon\Carbon;
    use Response;

    class CategoryController extends Controller

    {


    //Return  view for catgory
      public function index()
      {
        return view('backend.categories');
      }


    // Getting all the categories using Datatabels
      public function getAllcategories()
      {
        $categories = Category::all();

        return Datatables::of($categories)
        ->editColumn('created_at', function ($categories) {
          return $categories->created_at ? with(new Carbon($categories->created_at))->format('d-M-Y') : '';
        })
        ->editColumn('updated_at', function ($categories) {
          return $categories->updated_at ? with(new Carbon($categories->updated_at))->format('d-M-Y') : '';
        })
        ->make(true);
      }


    // add Category
      public function create(Request $request)
      {
        $request->validate([
         'category_name' => 'Required|min:3|max:255',
       ]);

        $slug = Str::slug($request->category_name);
        
        $category = Category::create([
         'name' => $request->category_name,
         'slug' => $slug,
       ]);
        return "Success";
      }

       // Get category 
      public function getCategory($id)
      {
       
       $category = Category::find($id);

       if ($category) {
         return $category;
       }else
       {
         return Response::json(['error' => 'Not Found'], 404);
       }
      }

     public function updateCategory(Request $request)
     {

      $request->validate([
        'edit_category_name' => 'Required|min:3|max:255',
      ],[
         'edit_category_name.required' => 'The category field is required.',
         'edit_category_name.min' => 'The category name should be min 3 characters.',
         'edit_category_name.max' => 'The category name may be not greater then 255 characters.',
      ]);

      $category = Category::find($request->category_id);
      $category->name = $request->edit_category_name;
      $category->slug = Str::slug($request->edit_category_name);
      $category->save();

      return "Success";

     }

     public function deleteCategory($id)
     {
      $category = Category::find($id);

      if ($category) 
      {
        $category->delete();
        return "Success";
      }else
      {
        return Response::json(['error' => 'Not Found', 404]);
      }
     }
     
  }