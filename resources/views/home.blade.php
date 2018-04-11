@extends('layouts.app')

@section('content')
    <div class="container">


        <div id="carousel-example-generic" class="carousel slide visible-md-block visible-lg-block "
             data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="position: relative; height: 500px; margin-bottom: 20px"
                 role="listbox">
                <div class="item active">
                    <img src="{{ url('/storage/images/clouthes2.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item ">
                    <img src="{{ url('/storage/images/clouthes3.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item ">
                    <img src="{{ url('/storage/images/clouthes4.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="panel panel-default">
            <div class="page-header">
                <h3 style="padding-left: 20px">健身房列表
                    <small> 共{{ count($rooms) }}条 </small>

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
                                    <a href="#" class="btn btn-default" role="button">办卡</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
