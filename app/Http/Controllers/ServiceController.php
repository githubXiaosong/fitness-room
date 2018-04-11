<?php

namespace App\Http\Controllers;

use App\Course;
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
}
