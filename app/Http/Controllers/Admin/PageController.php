<?php

namespace App\Http\Controllers\Admin;

use App\Clouthes;
use App\Course;
use App\Http\Controllers\Controller;
use App\Product;
use App\Room;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;


class PageController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function welcome()
    {
        return view('admin.welcome');
    }

    public function memberList()
    {
        $users = User::get();
        return view('admin.member-list')->with(['users' => $users]);
    }

    public function memberAdd()
    {
        return view('admin.member-add');
    }

    public function memberEdit($id)
    {
        $user = User::find($id);
        return view('admin.member-edit')->with(['user' => $user]);
    }

    public function roomList()
    {
        $rooms = Room::get();
        return view('admin.room-list')->with(['rooms' => $rooms]);
    }

    public function roomAdd()
    {
        return view('admin.room-add');
    }

    public function roomEdit($id)
    {
        $room = Room::find($id);
        return view('admin.room-edit')->with(['room' => $room]);
    }

    public function courseList()
    {
        $courses = Course::with(['room','users'])->get();
        return view('admin.course-list')->with(['courses' => $courses]);
    }

    public function courseAdd()
    {
        $rooms = Room::get();
        return view('admin.course-add')->with(['rooms' => $rooms]);
    }

    public function courseEdit($id)
    {
        $rooms = Room::get();

        $course = Course::with(['room'])->find($id);
        return view('admin.course-edit')->with(['course' => $course, 'rooms' => $rooms]);
    }

    public function courseUsers($course_id)
    {
        $course = Course::where(['id'=>$course_id])->with(['users','room'])->first();
        return view('admin.course-users')->with(['course' => $course]);
    }

    public function productList()
    {
        $products = Product::get();
        return view('admin.product-list')->with(['products' => $products]);
    }

    public function productAdd()
    {
        return view('admin.product-add');
    }

    public function productEdit($id)
    {
        $product = Product::find($id);
        return view('admin.product-edit')->with(['product' => $product]);
    }


}
