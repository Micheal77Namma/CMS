<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\User;
use\App\Models\post;
use\App\Models\tag;
use\App\Models\category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

	    public function dashboard()
    {
        return view('dashboard')
        ->with('tags_count' , tag::all()->count() )
        ->with('post_count' , post::all()->count() )
        ->with('users_count' , User::all()->count())
        ->with('categories_count' , category::all()->count())
       ->with('trashed_count' , post::onlyTrashed()->get()->count())  ;
    }

}
