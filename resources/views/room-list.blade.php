@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="panel panel-default">
            <div class="page-header">
                <h3 style="padding-left: 20px">健身房列表
                    <small> 共{{ count($rooms) }}条</small>

                </h3>
            </div>

            <div class="panel-body">

                @foreach($rooms as $room)
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <img style="" src="{{ '/storage/'.$room->cover_uri }}" alt="...">

                            <div class="caption">

                                <div>
                                    <h3 class="pull-left">{{ $room->title }}</h3>

                                    <h3 class="pull-right" style="font-size: 15px">{{ $room->current_num }}人</h3>

                                    <div style="clear: both;"></div>
                                </div>


                                <p><strong>地址:</strong>{{ $room->location }}</p>

                                <p><strong>器材简介:</strong>{{ $room->equipment_desc }}</p>

                                <p>
                                    <a href="{{ url('courseList/'.$room->id) }}" class="btn btn-primary" role="button">约课</a>
                                    <a onclick="submit_as_form('{{url('api/makeCard')}}','room_id','{{ $room->id }}')" class="btn btn-default" role="button" >
                                        {{ $room->is_carded?'退卡':'办卡' }}
                                    </a>

                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

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

