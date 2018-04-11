<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <link rel="stylesheet" href="/css/common.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">

    <script>
        @if (session('suc_msg'))
        Toast('{{ session('suc_msg') }}', 2000);
        @endif
    </script>


    <form class="layui-form" action="{{ url('admin/api/editUser') }}" method="post">

        <input type="hidden" name="user_id" value="{{ $user->id }}">

        {{ csrf_field() }}

        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>邮箱
            </label>

            <div class="layui-input-inline  {{ $errors->has('email') ? 'error-input' : '' }}">
                <input type="text" id="L_email" name="email" required=""
                       autocomplete="off" class="layui-input" value="{{ $user->email }}" autofocus>
            </div>
            @if ($errors->has('email'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="layui-form-item">
            <label for="L_name" class="layui-form-label">
                <span class="x-red">*</span>姓名
            </label>

            <div class="layui-input-inline  {{ $errors->has('name') ? 'error-input' : '' }}">
                <input type="text"  name="name" required="" id="name"
                       autocomplete="off" class="layui-input" value="{{ $user->name }}" autofocus>
            </div>
            @if ($errors->has('name'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="layui-form-item">
            <label for="L_phone" class="layui-form-label">
                <span class="x-red">*</span>手机号
            </label>

            <div class="layui-input-inline  {{ $errors->has('phone') ? 'error-input' : '' }}">
                <input type="text"  name="phone" required="" id="phone"
                       autocomplete="off" class="layui-input" value="{{ $user->phone }}" autofocus>
            </div>
            @if ($errors->has('phone'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" lay-filter="add" lay-submit="">
                修改
            </button>
            <a style="padding-left: 20px" href="{{ url('admin/memberList') }}">返回</a>
        </div>
    </form>
</div>

</body>

</html>