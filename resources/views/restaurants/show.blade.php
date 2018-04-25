<!-- inherit from app blade.php -->
@extends('layouts.master')

@section("title")
-  {{$restaurant->name}}
@endsection
@section('content')
<a href='{{route('restaurants.index')}}' link_to restaurants_path, class='btn btn-primary btn-lg' title='See all restaurants'>
   <i class='glyphicon glyphicon-arrow-left'></i> View Restaurants
</a>
<div class='row'>

    <div class='restaurant col-sm-7'>
            <h2 class='text-center restaurant-name'>{{$restaurant->name}}</h2>
            {{-- Image<br>[image here]<br> --}}
            {{--  --}}
            {{-- <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                  
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img class='img-responsive' src="https://images.pexels.com/photos/6267/menu-restaurant-vintage-table.jpg?auto=compress&cs=tinysrgb&h=350 1x, https://images.pexels.com/photos/6267/menu-restaurant-vintage-table.jpg?auto=compress&cs=tinysrgb&dpr=2&h=350 2x" alt="...">
                            <div class="carousel-caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class='img-responsive' src="https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&h=350 1x, https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350 2x" alt="...">
                            <div class="carousel-caption">
                                <p>consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class='img-responsive' src="https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg?auto=compress&cs=tinysrgb&h=350 1x, https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350 2x" alt="...">
                            <div class="carousel-caption">
                                <p>Lorem ipsum dolor sit amet</p>
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
                  </div> --}}
            {{--  --}}
            {{$restaurant->full_address()}}
            <div class='row' style='margin-left:0; margin-right:0'>
                <ul class='more-info'>
                  <li class="clearfix col-sm-11 col-sm-center-offset-1">
                      <span class="pull-left field-name">Type:</span>
                      <span class="qty pull-right">
                        {{-- <%= render 'category', categories: @restaurant.categories %> --}}
                      </span>
                  </li>
                    <li class="clearfix col-sm-5 col-sm-center-offset-1">
                        <span class="pull-left field-name">Parking:</span>
                        <span class="qty pull-right">Yes</span>
                    </li>
                    <li class="clearfix col-sm-5 col-sm-center-offset-1">
                        <span class="pull-left field-name">WiFi:</span>
                        <span class="qty pull-right">Yes</span>
                    </li>
                    <li class="clearfix col-sm-5 col-sm-center-offset-1">
                        <span class="pull-left field-name">Outdoor Seating:</span>
                        <span class="qty pull-right">No</span>
                    </li>
                {{-- </ul>
                <ul class='more-info'> --}}
                    <li class="clearfix col-sm-5 col-sm-center-offset-1">
                        <span class="pull-left field-name">Takeaway:</span>
                        <span class="qty pull-right">No</span>
                    </li>
                    <li class="clearfix col-sm-5 col-sm-center-offset-1">
                        <span class="pull-left field-name">Delivery:</span>
                        <span class="qty pull-right">No</span>
                    </li>
                    <li class="clearfix col-sm-5 col-sm-center-offset-1">
                        <span class="pull-left field-name">Serving Times:</span>
                        <span class="qty pull-right">No</span>
                    </li>
                </ul>
            </div>

            <!--Parking: Yes<br>-->
            <!--Wifi: Yes<br>-->
            <!--Type: Chinese<br>-->
            <!--Outdoor Seating : No<br>-->
            <!--Takeaway: No<br>-->
            <!--Delivery: No<br>-->
            <!--Serving Times: All day (See website for times)-->

            <h3>DESCRIPTION</h3>
            {!!$restaurant->description!!}

            <style>

            </style>
            <div class="row" style="margin-top:10px;">
                <div class='col-xs-12 col-sm-6 col-lg-5'>
                    <a href='{{route('restaurants.edit',[$restaurant->id])}}' id='edit-restaurant' class='btn btn-primary btn-lg' title='Modify current restaurant'>
                        Edit Restaurant <i class='glyphicon glyphicon-pencil'></i>
                    </a>
                </div>

                <div class='col-xs-12 col-sm-6 col-lg-offset-2 col-lg-5'>
                    {!!Form::open(['action'=>['RestaurantController@destroy',$restaurant->id],'method'=>'POST'])!!}
                        {!! Form::button('Delete Restaurant <i class="glyphicon glyphicon-trash"></i>', ['id'=>'delete-restaurant','class' => 'btn btn-danger btn-lg','type' => 'submit']) !!}
                        {{Form::hidden('_method','DELETE')}}
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
        <div class='col-sm-4' style='padding:10px;' >
            {{-- <%= render 'layouts/map' %> --}}
            {{--@include('inc.map')--}}
            <%= render 'layouts/owner' %>
            <%= render 'layouts/search_form' %>
        </div>
    </div>

@endsection