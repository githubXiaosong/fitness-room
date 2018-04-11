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
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <link rel="stylesheet" href="/css/common.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
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

    <form class="layui-form" action="{{ url('admin/api/addRoom') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="layui-form-item">
            <label for="L_title" class="layui-form-label">
                <span class="x-red">*</span>名称
            </label>

            <div class="layui-input-inline  {{ $errors->has('title') ? 'error-input' : '' }}">
                <input type="text" id="L_title" name="title" required=""
                       autocomplete="off" class="layui-input" value="{{ old('title') }}" autofocus>
            </div>
            @if ($errors->has('title'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="layui-form-item">
            <label for="L_location" class="layui-form-label">
                <span class="x-red">*</span>位置
            </label>

            <div class="layui-input-inline  {{ $errors->has('location') ? 'error-input' : '' }}">
                <input type="text"  name="location" required="" id="location"
                       autocomplete="off" class="layui-input" value="{{ old('location') }}" autofocus>
            </div>
            @if ($errors->has('location'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>


        <div class="layui-form-item">
            <label for="L_phone" class="layui-form-label">
                <span class="x-red">*</span>器材简介
            </label>

            <div class="layui-input-inline  {{ $errors->has('equipment_desc') ? 'error-input' : '' }}">
                <input type="text"  name="equipment_desc" required="" id="equipment_desc"
                       autocomplete="off" class="layui-input" value="{{ old('equipment_desc') }}" autofocus>
            </div>
            @if ($errors->has('equipment_desc'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('equipment_desc') }}</strong>
                </span>
            @endif
        </div>

        <div class="layui-form-item">
            <label for="L_cover" class="layui-form-label">
                <span class="x-red">*</span>封面图片
            </label>

            <div class="layui-input-inline  {{ $errors->has('cover') ? 'error-input' : '' }}">
                <input type="file"  name="cover" required="" id="cover"
                       autocomplete="off" class="layui-input" value="{{ old('cover') }}" autofocus>
            </div>
            @if ($errors->has('cover'))
                <span class="help-block error-text">
                    <strong>{{ $errors->first('cover') }}</strong>
                </span>
            @endif
        </div>


        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" lay-filter="add" lay-submit="">
                增加
            </button>
            <a style="padding-left: 20px" href="{{ url('admin/roomList') }}">返回</a>
        </div>


    </form>
</div>
<script>


</script>

</body>

</html>