@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="panel panel-default">
            <div class="page-header">
                <h3 style="padding-left: 20px">器材列表
                    <small> 共{{ count($products) }}条</small>

                </h3>
            </div>

            <div class="panel-body">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">

                            <img style="" src="{{ '/storage/'.$product->cover_uri }}" alt="...">

                            <div class="caption">
                                <div>
                                    <h3 class="pull-left">{{ $product->title }}</h3>

                                    <h3 class="pull-right" style="font-size: 15px">￥{{ $product->price }}元</h3>
                                    <a href="{{ $product->url }}">
                                        <button class="btn btn-xs col-md-12">选购地址</button>
                                    </a>

                                    <div style="clear: both;"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>

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
@endsection
