<?php

namespace App\Http\Controllers\Admin;

use App\Clouthes;
use App\Course;
use App\Http\Controllers\Controller;
use App\News;
use App\Product;
use App\Room;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    public function addUser()
    {

        $validator = Validator::make(
            rq(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
                'phone' => 'required|digits:11|unique:users',
            ],
            [
                'name.required' => '姓名为必填项',
                'name.max' => '姓名的最大长度为255',
                'email.required' => '邮箱为必填项',
                'email.unique' => '该邮箱已经被注册',
                'email.email' => '邮箱必须为合法的邮箱地址',
                'email.max' => '邮箱的最大长度为255',
                'password.required' => '密码为必填项',
                'password.min' => '密码最短为6',
                'phone.required' => '手机号为必填项',
                'phone.digits' => '手机号必须为11位的数字',
                'phone.unique' => '该手机号已经存在'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $user = new User();
        $user->name = rq('name');
        $user->email = rq('email');
        $user->password = bcrypt(rq('password'));
        $user->phone = rq('phone');
        $user->save();

        return back()->with('suc_msg', '添加成功');
    }

    public function editUser()
    {

        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id',
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique_other_email:' . rq('user_id'),
                'phone' => 'required|digits:11|unique_other_phone:' . rq('user_id')
            ],
            [
                'name.required' => '姓名为必填项',
                'name.max' => '姓名的最大长度为255',
                'email.required' => '邮箱为必填项',
                'email.email' => '邮箱必须为合法的邮箱地址',
                'email.unique_other_email' => '邮箱已经存在',
                'email.max' => '邮箱的最大长度为255',
                'phone.required' => '手机号为必填项',
                'phone.digits' => '手机号必须为11位的数字',
                'phone.unique_other_phone' => '手机号已经存在'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $user = User::find(rq('user_id'));
        $user->name = rq('name');
        $user->email = rq('email');
        $user->phone = rq('phone');
        $user->save();

        return back()->with('suc_msg', '修改成功');
    }

    public function changeUserStatus()
    {
        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id',

            ],
            [
                'user_id.required' => '用户ID不存在',
                'user_id.exists' => '用户ID查找不到'

            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $user = User::find(rq('user_id'));
        $user->status = $user->status == 0 ? '1' : '0';
        $user->save();

        return back()->with('suc_msg', '修改成功');

    }

    public function deleteUser()
    {

        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id'
            ],
            [
                'user_id.required' => '用户ID不存在',
                'user_id.exists' => '用户ID查找不到'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $user = User::find(rq('user_id'));
        $user->delete();

        return back()->with('suc_msg', '删除成功');

    }


    public function addRoom(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'title' => 'required|max:255',
                'location' => 'required|max:255',
                'equipment_desc' => 'required|max:255',
                'cover' => 'required|image'
            ],
            [
                'title.required' => '名称不存在',
                'title.max' => '名称的最大长度为255',
                'location.required' => '位置不存在',
                'location.max' => '位置的最大长度为255',
                'equipment_desc.required' => '器材描述不存在',
                'equipment_desc.max' => '器材描述的最大长度我255',
                'cover.required' => '封面图片不存在',
                'cover.image' => '文件类型不是图片'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $room = new Room();
        $room->title = rq('title');
        $room->location = rq('location');
        $room->equipment_desc = rq('equipment_desc');
        $cover_path = $request->cover->store('images', 'public');
        $room->cover_uri = $cover_path;
        $room->save();

        return back()->with('suc_msg', '添加成功');
    }

    public function editRoom(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'room_id' => 'required|exists:rooms,id',
                'title' => 'required|max:255',
                'location' => 'required|max:255',
                'equipment_desc' => 'required|max:255',
                'cover' => 'image'
            ],
            [
                'room_id.required' => '房间ID不存在',
                'room_id.exists' => '房间ID不在表中',
                'title.required' => '名称不存在',
                'title.max' => '名称的最大长度为255',
                'location.required' => '位置不存在',
                'location.max' => '位置的最大长度为255',
                'equipment_desc.required' => '器材描述不存在',
                'equipment_desc.max' => '器材描述的最大长度我255'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $room = Room::find(rq('room_id'));
        $room->title = rq('title');
        $room->location = rq('location');
        if ($request->cover) {
            $cover_path = $request->cover->store('images', 'public');
            $room->cover_uri = $cover_path;
        }
        $room->equipment_desc = rq('equipment_desc');
        $room->save();

        return back()->with('suc_msg', '修改成功');
    }


    public function changeRoomStatus()
    {

        $validator = Validator::make(
            rq(),
            [
                'room_id' => 'required|exists:rooms,id',

            ],
            [
                'room_id.required' => '健身房ID不存在',
                'room_id.exists' => '健身房ID查找不到'

            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());


        $room = Room::find(rq('room_id'));
        $room->status = $room->status == 0 ? '1' : '0';
        $room->save();

        return back()->with('suc_msg', '修改成功');

    }

    public function deleteRoom()
    {

        $validator = Validator::make(
            rq(),
            [
                'room_id' => 'required|exists:rooms,id'
            ],
            [
                'room_id.required' => '房间ID不存在',
                'room_id.exists' => '房间ID查找不到'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $room = Room::with(['courses'])->find(rq('room_id'));

        foreach ($room->courses as $course) {
            //删除选课信息
            DB::table('course_user')
                ->where('course_id', $course->id)->delete();

            //删除课程
            DB::table('courses')
                ->where('id', $course->id)->delete();
        }

        $room->delete();

        return back()->with('suc_msg', '删除成功');
    }

    public function addCourse()
    {

        $validator = Validator::make(
            rq(),
            [
                'title' => 'required|max:255',
                'desc' => 'required|max:255',
                'room_id' => 'required|exists:rooms,id',
                'time' => 'required',
            ],
            [
                'title.required' => '名称不存在',
                'title.max' => '名称的最大长度为255',
                'desc.required' => '描述值为必须',
                'desc.max' => '描述的最大长度为255',
                'room_id.required' => '房间ID不存在',
                'room_id.exists' => '房间ID在表中不存在',
                'time.required' => '开课时间不存在'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $course = new Course();
        $course->title = rq('title');
        $course->desc = rq('desc');
        $course->room_id = rq('room_id');
        $course->time = rq('time');
        $course->save();

        return back()->with('suc_msg', '添加成功');
    }


    public function deleteCourse()
    {

        $validator = Validator::make(
            rq(),
            [
                'course_id' => 'required|exists:courses,id'
            ],
            [
                'course_id.required' => '课程ID不存在',
                'course_id.exists' => '课程ID查找不到'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $course = Course::find(rq('course_id'));

        //删除选课信息
        DB::table('course_user')
            ->where('course_id', $course->id)->delete();

        $course->delete();

        return back()->with('suc_msg', '删除成功');
    }


    public function editCourse()
    {

        $validator = Validator::make(
            rq(),
            [
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|max:255',
                'desc' => 'required|max:255',
                'time' => 'required',
            ],
            [
                'course_id.required' => '课程ID不存在',
                'course_id.exists' => '课程ID不在表中',
                'title.required' => '标题不存在',
                'title.max' => '标题的最大长度为255',
                'time.required' => '开课时间不存在',
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $course = Course::find(rq('course_id'));
        $course->title = rq('title');
        $course->desc = rq('desc');
        $course->time = rq('time');
        $course->save();

        return back()->with('suc_msg', '修改成功');
    }


    public function addProduct(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'title' => 'required|max:255',
                'price' => 'required|digits_between:0,10000000',
                'url' => 'required|active_url',
                'cover' => 'required|image'
            ],
            [
                'title.required' => '标题不存在',
                'title.max' => '标题的最大长度不能超过255',
                'price.required' => '价格不存在',
                'price.digits_between' => '价格范围不正确',
                'url.required' => '连接地址不存在',
                'url.active_url' => '连接地址不合法',
                'cover.required' => '封面图片不存在',
                'cover.image' => '封面必须为图片类型'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $product = new Product();
        $product->title = rq('title');
        $product->price = rq('price');
        $product->url = rq('url');
        $cover_path = $request->cover->store('images', 'public');
        $product->cover_uri = $cover_path;
        $product->save();

        return back()->with('suc_msg', '添加成功');
    }

    //测试
    public function editProduct(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'product_id' => 'required|exists:products,id',
                'title' => 'required|max:255',
                'price' => 'required|digits_between:0,10000000',
                'url' => 'required|active_url',
                'cover' => 'image'
            ],
            [
                'product_id.required' => '产品ID不存在',
                'product_id.exists' => '产品ID不在表中',
                'title.required' => '标题不存在',
                'title.max' => '标题的最大长度不能超过255',
                'price.required' => '价格不存在',
                'price.digits_between' => '价格范围不正确',
                'url.required' => '连接地址不存在',
                'url.active_url' => '连接地址不合法',
                'cover.required' => '封面图片不存在',
                'cover.image' => '封面必须为图片类型'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $product = Product::find(rq('product_id'));
        $product->title = rq('title');
        $product->url = rq('url');
        $product->price = rq('price');
        if ($request->cover) {
            $cover_path = $request->cover->store('images', 'public');
            $product->cover_uri = $cover_path;
        }
        $product->save();

        return back()->with('suc_msg', '修改成功');
    }

    public function changeProductStatus()
    {

        $validator = Validator::make(
            rq(),
            [
                'product_id' => 'required|exists:products,id',

            ],
            [
                'product_id.required' => '产品ID不存在',
                'product_id.exists' => '产品ID查找不到'

            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());


        $product = Product::find(rq('product_id'));
        $product->status = $product->status == 0 ? '1' : '0';
        $product->save();

        return back()->with('suc_msg', '修改成功');

    }

    public function deleteProduct()
    {

        $validator = Validator::make(
            rq(),
            [
                'product_id' => 'required|exists:products,id'
            ],
            [
                'product_id.required' => '产品ID不存在',
                'product_id.exists' => '产品ID查找不到'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        Product::find(rq('product_id'))->delete();

        return back()->with('suc_msg', '删除成功');
    }

    //
    public function addNews(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'title' => 'required|max:255',
                'desc' => 'required|max:255',
                'cover' => 'required|image'
            ],
            [
                'title.required' => '标题不存在',
                'title.max' => '标题的最大长度不能超过255',
                'cover.required' => '封面图片不存在',
                'cover.image' => '封面必须为图片类型'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        $news = new News();
        $news->title = rq('title');
        $news->desc = rq('desc');
        $cover_path = $request->cover->store('images', 'public');
        $news->cover_uri = $cover_path;
        $news->save();

        return back()->with('suc_msg', '添加成功');
    }

    public function changeNewsStatus()
    {

        $validator = Validator::make(
            rq(),
            [
                'news_id' => 'required|exists:news,id',

            ],
            [
                'news_id.required' => '产品ID不存在',
                'news_id.exists' => '产品ID查找不到'

            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());


        $news = News::find(rq('news_id'));
        $news->status = $news->status == 0 ? '1' : '0';
        $news->save();

        return back()->with('suc_msg', '修改成功');

    }

    public function deleteNews()
    {

        $validator = Validator::make(
            rq(),
            [
                'news_id' => 'required|exists:news,id'
            ],
            [
                'news_id.required' => '产品ID不存在',
                'news_id.exists' => '产品ID查找不到'
            ]
        );
        if ($validator->fails())
            return back()->withErrors($validator->messages());

        News::find(rq('news_id'))->delete();

        return back()->with('suc_msg', '删除成功');
    }
}

