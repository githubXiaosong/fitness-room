<?php

namespace App\Http\Controllers;

use App\Course;
use App\Product;
use App\Room;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

    public function roomList()
    {
        $rooms = Room::where(['status'=>STATUS_NORMAL])->with(['courses'])->get();
        return view('room-list')->with(['rooms' => $rooms]);
    }

    public function productList()
    {
        $products = Product::where(['status' => STATUS_NORMAL])->get();

        return view('product-list')->with(['products' => $products]);
    }


    public function courseList($room_id)
    {
        $room = Room::with(['courses'])->find($room_id);

        $auther = Auth::user();
        foreach($room->courses as $course){
            $course->users = Course::with(['users'])->find($course->id)->users;
            $course->is_ordered = false;
            foreach($course->users as $user){

                if($user->id == $auther->id){
                    $course->is_ordered = true;
                    break;
                }
            }
        }

        return view('course-list')->with(['room' => $room]);
    }

    public function myCourse()
    {
        $user = Auth::user();

        $user = User::with(['courses'])->find($user->id);

        foreach($user->courses as $course){
            $course->room = Course::with(['room'])->find($course->id)->room;
        }

        return view('my-course')->with(['user' => $user]);
    }


}
