<?php

namespace App\Http\Controllers;
use App\Album;
use Illuminate\Http\Request;

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
        $albums = Album::orderBy('id','DESC')->paginate(10);
        return view('/albums',['albums'=>$albums]);
    }
}
