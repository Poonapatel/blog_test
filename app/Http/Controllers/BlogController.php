<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Validator;
use App\Blog;
use App\Category;
use App\BlogCategory;
use DB;

class BlogController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function addForm()
    {

        $categories = Category::all();
        return view('blog.add-blog', compact('categories'));
    }

    public function add(BlogRequest $request)
    { 
    	// return $request->all();
        $request->request->add(['user_id' => auth()->user()->id]); //add request

    	// DB::beginTransaction();

    	// try
     //    {
               
        	$newData = Blog::create($request->all()); // store data

        	foreach ($request->categories as $key => $value) {
        		BlogCategory::create([
        			"blog_id" => $newData->id,
        			"category_id" => $value,
        		]);
        	}

        	// DB::commit();
        // }
        // catch (\Exception $e)
        // {
        // 	DB::rollBack();
        // 	return redirect('/add-blog')		        
        // 	->withInput();
            
        // }


        return redirect('/home')->with('status', "Blog Added Successfully");
    }   

    public function share(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'event_id' => 'required',
        ]);

        if ($validator->fails()) {
          return redirect('/home')->with('status_err', "Something Went wrong! Plase try again");
        }

        $id = $request->event_id;    	
        $email = $request->email;    	
        $data = Event::find($id);

        if(empty($data))
          return redirect('/home')->with('status_err', "Something Went wrong! Plase try again");

        try {

            Mail::to($email)->send(new ShareEvent($data));

        } catch (Exception $e) {
            
            return redirect('/home')->with('status_err', "Something Went wrong! Plase try again");
        }

        return redirect('/home')->with('status', "Event Shared Successfully");
    }
}
