<!-- inherit from app blade.php -->
@extends('layouts.master')

@section("title")
-  {{$restaurant->name}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/jquery.raty.css')}}">
@endsection

@section('content')
<a href='{{route('restaurants.index')}}' link_to restaurants_path, class='btn btn-primary btn-lg' title='See all restaurants' id='view-restaurants'>
        <i class="fas fa-hand-point-left"></i> View Restaurants
</a>
<div class='row'>

    <div class='restaurant col-sm-7'>
            <h2 class='text-center restaurant-name'>{{$restaurant->name}}</h2>
            {{-- Image<br>[image here]<br> --}}
            {{--  --}}
            <a class="overlay" title="View fullsize photo" href="
            <?php 
                if($restaurant->cover_image)
                {
                    echo asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image);
                }
                else
                {
                    echo asset('imgs/placeholder/restaurant.png');
                }
            ?>">
            {{-- {{asset('imgs/placeholder/restaurant.png')}} --}}
                <span class="more"></span>
                @if($restaurant->cover_image)
                <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}">
                    @else
                        <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image avaliable" alt="No image avaliable">
                    @endif
            </a>
            {{--  --}}
            <div class='address'>
                <div class='text-center'>{{$restaurant->full_address()}}</div>
            </div>
            <div class='row' style='margin-left:0; margin-right:0'>
                <div class='col-sm-12'>
                    <ul class='more-info'>
                    <li class="clearfix col-sm-11 col-sm-center-offset-1">
                        {{-- <span class="pull-left field-name">Type:</span>
                        <span class="qty pull-right cuisine-value"> --}}
                            {{-- <%= render 'category', categories: @restaurant.categories %> --}}
                        {{-- </span> --}}
                        <div class="field-name">Cuisine Type:</div>
                        <div class='cuisine-value'>

                            @if($restaurant->cuisines()->count() > 0)
                                <?php //print_r($restaurant->cuisines()->get()->implode('name',', ')); ?>
                                {{-- @foreach($restaurant->cuisines as $cuisine)
                                    {{$cuisine->name}}
                                @endforeach --}}
                                {{$restaurant->cuisines()->get()->implode('name',', ')}}
                            @else
                                Not specified
                            @endif
                        </div>
                        

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
            {{-- </div> --}}

            <!--Parking: Yes<br>-->
            <!--Wifi: Yes<br>-->
            <!--Type: Chinese<br>-->
            <!--Outdoor Seating : No<br>-->
            <!--Takeaway: No<br>-->
            <!--Delivery: No<br>-->
            <!--Serving Times: All day (See website for times)-->
                <div class='col-sm-12'>
                    <h3>DESCRIPTION</h3>
                    {!!$restaurant->description!!}
                </div>
            </div>
            <style>

            </style>
            <div class="row" style="margin-top:10px;">
                <div class='col-xs-12 col-sm-6 col-lg-5'>
                    <a href='{{route('restaurants.edit',[$restaurant->id])}}' id='edit-restaurant' class='btn btn-primary' title='Modify current restaurant'>
                        Edit Restaurant <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>

                <div class='col-xs-12 col-sm-6 col-lg-offset-2 col-lg-5'>
                    {!!Form::open(['action'=>['RestaurantController@destroy',$restaurant->id],'method'=>'POST'])!!}
                        {!! Form::button('Delete Restaurant <i class="fas fa-trash-alt"></i>', ['id'=>'delete-restaurant','class' => 'btn btn-danger','type' => 'submit']) !!}
                        {{Form::hidden('_method','DELETE')}}
                    {!!Form::close()!!}
                </div>
            </div>
            <hr>
            {{--  Reviews --}}
            @include('inc.reviews')
        </div>
        <div class='col-sm-4' style='padding:10px;' >
            {{-- <%= render 'layouts/map' %> --}}
            {{--@include('inc.map')--}}
            <%= render 'layouts/owner' %>
            <%= render 'layouts/search_form' %>
        </div>
    </div>
@endsection


{{-- @section('style')
<style>
    @media only screen and (min-width:768px)
    {
        .address div
        {
            transform: translateX(50%);
            /* transform: translateX(50%); */
        }
    }
</style>
@endsection --}}

@section('script')
<script src="{{asset('js/jquery.raty.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.star-rating').raty({
             path:     "{{asset('/imgs/rating')}}",
            //path:     "/imgs/rating/",
            readOnly: true,
            numberMax: 5,
            score:    function(){
            return $(this).attr('data-score');
            }
        });
    });
</script>
@endsection