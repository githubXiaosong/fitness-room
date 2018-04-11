@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="panel panel-default">
            <div class="page-header">
                <h3 style="padding-left: 20px">{{ $user->name }}
                    <small> {{ $user->phone }} </small>
                </h3>
            </div>

            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>描述</th>
                        <th>所属健身房</th>
                        <th>地址</th>
                        <th>开课时间</th>
                        <th>约课人数</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($user->courses as $course)
                        <tr>
                            <td>{{$course->title}}</td>
                            <td>{{$course->desc}}</td>
                            <td>{{$course->room->title}}</td>
                            <td>{{$course->room->location}}</td>
                            <td>{{$course->time}}</td>
                            <td>{{ count($course->users) }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs" role="button"
                                   onclick="submit_as_form('{{url('/api/orderCourse')}}','course_id','{{ $course->id }}')">取消预约</a>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

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
