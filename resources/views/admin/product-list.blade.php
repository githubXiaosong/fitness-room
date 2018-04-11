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
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script src="/js/common.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>


<div class="x-body">

    <xblock>

        <a href="{{ url('admin/productAdd') }}">
            <button class="layui-btn"><i
                        class="layui-icon"></i>添加
            </button>
        </a>

        <span class="x-right" style="line-height:40px">共有数据：{{ count($products) }} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">
                        &#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>标题</th>
            <th>封面图片</th>
            <th>价格</th>
            <th>连接地址</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)


            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i>
                            class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td><img class="img-circle img-square"
                         src="{{ '/storage/'.$product->cover_uri }}"></td>
                <td>{{ $product->price }}</td>
                <td>{{ substr($product->url,0,40).'...' }}</td>
                <td class="td-status">
                    <span class="layui-btn {{$product->status==STATUS_NORMAL?:'layui-btn-normal'}} layui-btn-mini">{{ $product->status==STATUS_OFF_NORMAL?'未启用':'已启用'}}</span>
                </td>

                <td class="td-manage">

                    <a href="#" onclick="layer.confirm('确认要停用/启用吗？',function(index){
                            submit_as_form('{{url('admin/api/changeProductStatus')}}','product_id','{{ $product->id }}')
                            });" title="{{ $product->status==STATUS_NORMAL?'停用':'启用' }}">
                        <i class="layui-icon">{{$product->status==STATUS_NORMAL?'&#xe601;':'&#xe62f;'}} </i>
                    </a>

                    <a title="编辑" href="{{ url('admin/productEdit/'.$product->id) }}">
                        <i class="layui-icon">&#xe642;</i>
                    </a>

                    <a title="删除" href="#" onclick="layer.confirm('确认要删除吗？',function(index){
                            submit_as_form('{{url('admin/api/deleteProduct')}}','product_id','{{ $product->id }}')
                            });">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>

        @endforeach
        </tbody>


    </table>
    <x></x>

</div>
<script>


    layui.use('laydate', function () {
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    //以表单形式提交参数
    function submit_as_form(url, data_name, data_value) {
        var form = '<form id="tmp_for_submit_form" method="post" action=" ' + url + ' " >' +
                '<input type="hidden" name="' + data_name + '" value=" ' + data_value + ' ">' +
                '{{ csrf_field() }}' +
                '</form>';
        $('body').append(form);
        $('#tmp_for_submit_form').submit();
    }

    @if (session('err_msg'))
    Toast('{{ session('err_msg') }}', 2000);
    @endif


    @if (session('suc_msg'))
    Toast('{{ session('suc_msg') }}', 2000);
    @endif


</script>

</body>

</html>