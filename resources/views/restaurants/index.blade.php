{{-- inherit from master blade.php --}}
@extends('layouts.master')

@section('meta')
    <meta name="description" content="All Restaurants">
    @overwrite
@section('title', '- Restaurants')

@section('content')
    <h1 class="text-center">Restaurants</h1>
    <div class="text-center">
        <a href="{{route('restaurants.create')}}" class="btn btn-primary btn-lg">
            New Restaurant <i class="glyphicon glyphicon-plus"></i>
        </a>
    </div>

    @if(count($restaurants))
    <div class='text-center' style='font-weight:bold; margin-top:20px;'>
        <strong>
            Showing 
            <span class='first-item'>{{$restaurants->firstItem()}}</span>
            - 
            <span class='last-item'>{{$restaurants->lastItem()}}</span>
            of 
            <span class='total-restaurants'>{{$restaurants->total()}}</span>
        </strong>
    </div>
    <div class='row result'>
        <ul class='restaurants'>
            @foreach($restaurants as $restaurant)
                <li id="restaurant{{$restaurant->id}}" class="col-xs-offset-1 col-xs-10 col-sm-5 col-sm-center-offset-1 col-lg-3 restaurant">
                    <div class="holder">
                        <div class="prop-info">
                            <h3 class="prop-title text-center">
                                <a href="{{route('restaurants.show',[$restaurant->id])}}">
                                    {{$restaurant->name}}
                                </a>
                            </h3>
                            <ul class='more-info'>
                                <li class="clearfix">
                                    <span class="pull-left field-name">Category:</span>
                                    <span class="qty pull-right">
                                        {{-- <%= render 'category', categories: restaurant.categories %> --}}
                                        Italien
                                    </span>
                                </li>

                                <li class="clearfix">
                                    <span class="pull-left field-name">Avg Rating:</span>
                                    <span class="qty pull-right avg-rating">
                                        @if($restaurant->reviews->count())
                                            <span class='star-rating' data-score={{$restaurant->reviews->avg('rating')}}></span>
                                            <span class='text-rating sr-only'>{{$restaurant->reviews->avg('rating')}}</span>
                                        @else
                                            No reviews yet.
                                        @endif
                                    </span>
                                </li>
                                <li class="clearfix id='average-rating-output'">
                                    <span class="pull-left field-name">Reviews:</span>
                                    <span class="qty pull-right no-of-reviews">
                                        @if($restaurant->reviews->count())
                                            {{$restaurant->reviews->count()}} <span class='glyphicon glyphicon-comment'></span>
                                        @else
                                            No reviews yet.
                                        @endif
                                    </span>
                                </li>
                                <li class="clearfix ">
                                    <span class="pull-left field-name">Location:</span>
                                    <span class="qty pull-right">
                                        {{$restaurant->full_address()}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class='text-center'>
        {{$restaurants->links()}}
    </div>
    @else
    <div class='row result'>  
            <div class="container">
                    <div class="jumbotron" style='background:#fff;'>
                        <p> No restaurants avaliable. </p>
                    </div>
            </div>
        </div>
    @endif
@endsection

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