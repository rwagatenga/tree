<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Category;
use App\Total;

use DB;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gets = Category::where('id', '=', Auth::user()->id)->get();
        $categories = Category::where('parent_id', '=', Auth::user()->id)->get();
        $views = User::where('id', '=', Auth::user()->id)->get();
        /*---------------*/
        
        /*---------------*/
        return view('home', compact('views', 'categories', 'gets'));
    }
}
