<?php

namespace App\Http\Controllers;

use App\Course;
use App\Product;
use App\Room;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function orderCourse(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'course_id' => 'required|exists:courses,id',
            ],
            [
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $user = Auth::user();

        $course = Course::find(rq('course_id'));


        $items = $course
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)->get();


        if (empty(json_decode($items)))
            $course->users()->attach($user->id);
        else
            $course
                ->users()
                ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
                ->where('user_id', $user->id)
                ->where('course_id', $course->id)->delete();


        return back()->with('suc_msg', '操作成功');
    }

    public function makeCard(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'room_id' => 'required|exists:rooms,id',
            ],
            [
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $user = Auth::user();

        $room = Room::find(rq('room_id'));


        $items = $room
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('user_id', $user->id)
            ->where('room_id', $room->id)->get();


        if (empty(json_decode($items)))
            $room->users()->attach($user->id);
        else
            $room
                ->users()
                ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
                ->where('user_id', $user->id)
                ->where('room_id', $room->id)->delete();


        return back()->with('suc_msg', '操作成功');
    }


    //APP

    /**
     * @return array
     * email
     * password
     */
    public function login()
    {

        $validator = Validator::make(
            rq(),
            [
                'email' => 'required|exists:users,email',
                'password' => 'required',
            ],
            [
            ]
        );
        if ($validator->fails())
            return $validator->messages();

        $email = rq('email');
        $password = rq('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return suc(User::where(['email'=>$email])->first());
        }

        return err(-1);
    }

    public function roomList()
    {

        return suc(Room::where(['status' => STATUS_NORMAL])->with(['courses'])->get());

    }

    public function productList()
    {
        return suc(Product::where(['status' => STATUS_NORMAL])->get());
    }


    /**
     * @return $this
     * room_id
     * user_id
     */
    public function courseList()
    {

        $validator = Validator::make(
            rq(),
            [
                'room_id' => 'required|exists:rooms,id',
                'user_id' => 'required|exists:users,id',
            ],
            [
            ]
        );
        if ($validator->fails())
            return $validator->messages();

        $room = Room::with(['courses'])->find(rq('room_id'));

        $user_id = rq('user_id');
        foreach ($room->courses as $course) {
            $course->users = Course::with(['users'])->find($course->id)->users;
            $course->is_ordered = false;
            foreach ($course->users as $user) {

                if ($user->id == $user_id) {
                    $course->is_ordered = true;
                    break;
                }
            }
        }

        return suc($room);
    }

    /**
     * @return $this
     * user_id
     */
    public function myCourse()
    {

        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id',
            ],
            [
            ]
        );
        if ($validator->fails())
            return $validator->messages();

        $user = User::with(['courses'])->find(rq('user_id'));

        foreach ($user->courses as $course) {
            $course->room = Course::with(['room'])->find($course->id)->room;
        }


        return suc($user);
    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse 移动端约课
     */
    public function AppOrderCourse(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'course_id' => 'required|exists:courses,id',
                'user_id' => 'required|exists:users,id'
            ],
            [
            ]
        );
        if ($validator->fails())
            return $validator->messages();

        $id = rq('user_id');

        $course = Course::find(rq('course_id'));

        $items = $course
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('user_id', $id)
            ->where('course_id', $course->id)->get();

        if (empty(json_decode($items)))
            $course->users()->attach($id);
        else
            $course
                ->users()
                ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
                ->where('user_id', $id)
                ->where('course_id', $course->id)->delete();

        return suc();
    }




}
