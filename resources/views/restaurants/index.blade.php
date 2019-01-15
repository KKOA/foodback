{{-- inherit from master blade.php --}}
@extends('layouts.master')

@section('meta')
    <meta name="description" content="All Restaurants">
    @overwrite
@section('title', 'Find the restaurant for you')

@section('content')
    <div class='row mb-3'>
        <h1 class="text-center col-12">Restaurants</h1>
        <div class="text-center col-12">
			<a href="{{route('restaurants.create')}}" class="btn btn-primary btn-lg add-restaurant">
				New Restaurant <i class="fa fa-plus"></i>
			</a>
        </div>
    </div>
    @if(count($restaurants))
    <div class='row mb-3'>
        <div class='col-12 text-center'>
            <strong>
                Showing 
                <span class='first-item'>{{$restaurants->firstItem()}}</span>
                - 
                <span class='last-item'>{{$restaurants->lastItem()}}</span>
                of 
                <span class='total-restaurants'>{{$restaurants->total()}}</span>
			</strong>
        </div>
	</div>
	<ul class='row restaurants'>
		@foreach($restaurants as $restaurant)
		{{-- <li id="restaurant{{$restaurant->id}}" class="col-xs-offset-1 col-xs-10 col-sm-5 col-sm-center-offset-1 col-lg-3 restaurant"> --}}
		<li id="restaurant{{$restaurant->id}}" class="offset-1 col-10 col-md-5 center-offset-md-1 col-xl-3 restaurant">
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
					<ul class='more-info align-items-center'>
						<li class="clearfix location">
							<div class='address text-center'>
									{{$restaurant->full_address()}}
							</div>
						</li>
						<li class="clearfix">
							<div class="field-name">Cuisine Type :</div>
							<div class='cuisine-value'>

								@if($restaurant->cuisines()->count() > 0)
									{{$restaurant->cuisines()->get()->implode('name',', ')}}
								@else
									Not specified
								@endif
							</div>
						</li>

						<li class="clearfix">
							<span class="float-left field-name">Avg Rating :</span>
							{{-- <span class="qty float-right avg-rating"> --}}
							<span class="qty float-right">
								@if($restaurant->reviews->count())
									<span class='avg-rating'>
										<span class='star-rating' data-score={{$restaurant->reviews->avg('rating')}}>
										</span>
										<span class='text-rating sr-only'>
											{{number_format((float)$restaurant->reviews->avg('rating'),2)}} 
										</span>
									</span>

									<span class='d-inline-block ml-1 no-of-reviews' title=' {{$restaurant->reviews->count()}} review{{$restaurant->reviews->count() > 1 ? "s" :""}}'>	 
										{{number_format((float)$restaurant->reviews->count(),0)}}
										<span class='sr-only'> review{{$restaurant->reviews->count() > 1 ? "s" :""}} </span>
										<i class="far fa-comment-alt"></i> 
									</span>
									
								@else
									No reviews yet.
								@endif
							</span>
						</li>
						{{-- <li class="clearfix id='average-rating-output'">
							<span class="pull-left field-name">Reviews:</span>
							<span class="qty pull-right no-of-reviews">
								@if($restaurant->reviews->count())
									{{$restaurant->reviews->count()}} 
									<i class="far fa-comment-alt"></i>
								@else
									No reviews yet.
								@endif
							</span>
						</li> --}}
					</ul>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	<div class='row'>
		<div class='col-12 text-center'>
				<span class='d-inline-block text-center'>{{$restaurants->links()}}</span>
		</div>
	</div>
	@else
	<div class='row result justify-content-center'>  
		<div class="col-md-10 col-xl-8">
			<div class="jumbotron" style='background:#fff;'>
				<h2 class='text-center'> No restaurants avaliable. </h2>
			</div>
		</div>
	</div>
    @endif
@endsection

@section('script')
<script src="{{mix('js/jquery.raty.js')}}"></script>
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