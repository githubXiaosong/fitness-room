<?php

function rq($key = null)
{
    return ($key == null) ? \Illuminate\Support\Facades\Request::all() : \Illuminate\Support\Facades\Request::get($key);
}

function suc($data = null)
{
    $ram = ['status' => 0];
    if ($data) {
        $ram['data'] = $data;
        return $ram;
    }
    return $ram;
}

function err($code, $data = null)
{
    if ($data)
        return ['status' => $code, 'data' => $data];
    return ['status' => $code];
}


Auth::routes();

Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'HomeController@index')->middleware('auth');
    Route::get('/home', 'HomeController@index')->middleware('auth');
    Route::get('/roomList', 'PageController@roomList')->middleware('auth');
    Route::get('/courseList/{room_id}', 'PageController@courseList')->middleware('auth');
    Route::get('/myCourse', 'PageController@myCourse')->middleware('auth');
    Route::get('/productList', 'PageController@productList');


    Route::group(['prefix' => 'api'], function () {
        Route::post('/orderCourse', 'ServiceController@orderCourse');

        //APP
        /**
         * 页面改APP接口步骤  1替换URL中传递参数的方式
         *                  2把其中用到AUTH的方法换为user_id
         */
        Route::get('/login', 'ServiceController@login');;
        Route::get('/roomList', 'ServiceController@roomList');;
        Route::get('/courseList', 'ServiceController@courseList');
        Route::get('/myCourse', 'ServiceController@myCourse');
        Route::get('/productList', 'ServiceController@productList');
        Route::get('/AppOrderCourse', 'ServiceController@AppOrderCourse');

    });


    Route::group(['prefix' => 'admin'], function () {
        Route::get('/index', 'Admin\PageController@index');
        Route::get('/login', 'Admin\PageController@login');
        Route::get('/welcome', 'Admin\PageController@welcome');

        Route::get('/memberAdd', 'Admin\PageController@memberAdd');
        Route::get('/memberEdit/{user_id}', 'Admin\PageController@memberEdit');
        Route::get('/memberList', 'Admin\PageController@memberList');

        Route::get('/roomAdd', 'Admin\PageController@roomAdd');
        Route::get('/roomEdit/{room_id}', 'Admin\PageController@roomEdit');
        Route::get('/roomList', 'Admin\PageController@roomList');

        Route::get('/newsAdd', 'Admin\PageController@newsAdd');
        Route::get('/newsList', 'Admin\PageController@newsList');

        Route::get('/courseAdd', 'Admin\PageController@courseAdd');
        Route::get('/courseEdit/{course_id}', 'Admin\PageController@courseEdit');
        Route::get('/courseList', 'Admin\PageController@courseList');
        Route::get('/courseUsers/{course_id}', 'Admin\PageController@courseUsers');

        Route::get('/productAdd', 'Admin\PageController@productAdd');
        Route::get('/productEdit/{product_id}', 'Admin\PageController@productEdit');
        Route::get('/productList', 'Admin\PageController@productList');


        Route::group(['prefix' => 'api'], function () {
            Route::post('/addUser', 'Admin\ServiceController@addUser');
            Route::post('/editUser', 'Admin\ServiceController@editUser');
            Route::post('/changeUserStatus', 'Admin\ServiceController@changeUserStatus');
            Route::post('/deleteUser', 'Admin\ServiceController@deleteUser');

            Route::post('/addRoom', 'Admin\ServiceController@addRoom');
            Route::post('/editRoom', 'Admin\ServiceController@editRoom');
            Route::post('/changeRoomStatus', 'Admin\ServiceController@changeRoomStatus');
            Route::post('/deleteRoom', 'Admin\ServiceController@deleteRoom');

            Route::post('/addCourse', 'Admin\ServiceController@addCourse');
            Route::post('/editCourse', 'Admin\ServiceController@editCourse');
            Route::post('/deleteCourse', 'Admin\ServiceController@deleteCourse');

            Route::post('/addProduct', 'Admin\ServiceController@addProduct');
            Route::post('/editProduct', 'Admin\ServiceController@editProduct');
            Route::post('/changeProductStatus', 'Admin\ServiceController@changeProductStatus');
            Route::post('/deleteProduct', 'Admin\ServiceController@deleteProduct');

            Route::post('/addNews', 'Admin\ServiceController@addNews');
            Route::post('/changeNewsStatus', 'Admin\ServiceController@changeNewsStatus');
            Route::post('/deleteNews', 'Admin\ServiceController@deleteNews');
        });
    });
});
