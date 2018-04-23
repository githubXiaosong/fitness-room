<?php

namespace App\Http\Controllers;

use App\Room;
use App\News;
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

        $news = News::where(['status'=>STATUS_NORMAL])->get();
        $rooms = Room::where(['status'=>STATUS_NORMAL])->with(['courses'])->get();
        return view('home')->with(['rooms' => $rooms,'news' => $news]);
    }
}
