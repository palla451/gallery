<?php

namespace App\Http\Controllers;
use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $query = Album::orderBy('id','DESC')->paginate(8);

        $albums = $query->where('user_id',Auth::user()->id);

        return view('/albums',['albums'=>$albums]);
    }
}
