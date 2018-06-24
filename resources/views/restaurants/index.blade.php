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
            New Restaurant <i class="fa fa-plus"></i>
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

{{--  --}}
{{-- <div class="holder">
    <a class="overlay" title="property title" href="#">
        <span class="more"></span>
        <img alt="image" src="images/02.jpg" class="media-object">
    </a>
    <span class="prop-tag">For Rent</span>
    <div class="prop-info">
        <h3 class="prop-title">8745 Annox Avenue Orlando 33139 FL</h3>
        <ul class="more-info clearfix">
            <li class="info-label clearfix"><span class="pull-left">Beds:</span> <span class="qty pull-right">4</span></li>
            <li class="info-label clearfix"><span class="pull-left">Baths:</span> <span class="qty pull-right">2</span></li>
        </ul>
    </div>
</div> --}}
{{--  --}}

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
                        </div>
                        <a class="overlay" title="View {{$restaurant->name}}" href="{{route('restaurants.show',[$restaurant->id])}}">
                            <span class="more"></span>
                            @if($restaurant->cover_image)
                                <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}">
                            @else
                                <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image avaliable" alt="No image avaliable">
                            @endif
                        </a>
                        <div class="prop-info">
                            <ul class='more-info'>
                                <li class="clearfix location">
                                    <div class='address'>
                                        {{$restaurant->full_address()}}
                                    </div>
                                </li>
                                <li class="clearfix">
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
                                            {{$restaurant->reviews->count()}} 
                                            {{-- <span class='glyphicon glyphicon-comment'></span> --}}
                                            {{-- <span class='fa fa-commenting-o'></span> --}}
                                            <i class="far fa-comment-alt"></i>
                                        @else
                                            No reviews yet.
                                        @endif
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
            readOnly: true,
            numberMax: 5,
            score:    function(){
            return $(this).attr('data-score');
            }
        });
    });
</script>
@endsection