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
                    <img src="{{ url('/storage/images/fitness_img1.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item ">
                    <img src="{{ url('/storage/images/fitness_img2.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item ">
                    <img src="{{ url('/storage/images/fitness_img3.jpg') }}" alt="...">

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
                <h3 style="padding-left: 20px">新闻

                </h3>
            </div>

            <div class="panel-body">


                @foreach($news as $item)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="{{ '/storage/'.$item->cover_uri }}" alt="...">
                            </a>

                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $item->title }}</h4>
                           {{ $item->desc }}
                            <br>
                            <p style="margin-top: 25px">{{ $item->created_at }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
