<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {        
        $search = empty($request->search) ? "" : Carbon::parse($request->search)->format('Y-m-d');

        $data = Blog::where('user_id', auth()->user()->id)->where(function($q) use($search) {
            if(!empty($search))
                $q->whereDate('created_at', $search);
        })->get(); 

        if($request->ajax())
            return view('ajax.blog-filter', compact('data'));

        return view('home', compact('data'));    
    }
}
