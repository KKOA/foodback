{{-- inherit from master blade.php --}}
@extends('layouts.master')

@section('meta')
    <meta name="description" content="All Restaurants">
    @overwrite
@section('title', 'Find the restaurant for you')

@section('content')

	<div class='row mb-3'>
        <h2 class="text-center col-12">Restaurants</h2>
        <div class="text-center col-12">
			<a href="{{route('restaurants.create')}}" class="btn btn-primary add-restaurant">
				New Restaurant <i class="fa fa-plus"></i>
			</a>
        </div>
	</div>
		@include('restaurants.filter', ['cuisines' => $cuisines])
	<div class=" row">	
		<div class="col-12 offset-md-1 col-md-10 result my-card">
			<header class='card-header bg-blue-header'>
				<h3 class="text-center">Results</h3>
			</header>
			<div class="remove-bs-padding">
				@if(count($restaurants))
					
					<div class='row mt-3 mb-3'>

						<?php 
							$sortOrderOption = [
								'Best_Match' => 'Best Match',
								'Name_Ascending' => 'Name(A - Z)',
								'Name_Descending' => 'Name(Z - A)',
								'Highest_rated'=>'Highest rated first',
								'Highest_price'=>'Highest price first',
								// 'Lowest_price'=>'Lowest price first',
								'Most_Reviewed'=>'Most Reviewed'
							];

							$displayQty = [];
							$totalRestaurant = $restaurants->total();
							for($i = 6; $i < $totalRestaurant; $i*=2)
							{
								$displayQty["$i"] = $i;
							}
							$displayQty["$totalRestaurant"] = $totalRestaurant;
						?>

						<div class='col-4 col-lg-3 text-right'>
							<label class="col-form-label" for='SortOrder'> Sort By </label>
						</div>
						<div class='col-7 col-sm-6 col-lg-3'>
							{{Form::select('sortOrder', $sortOrderOption, null, ['class'=>'form-control','id'=>'SortOrder'])}}

						</div>

						@if($restaurants->total() > 6)
							<div class='col-4 col-lg-3 text-right'>
								<label class="col-form-label" for='displayQty'> Display </label>
							</div>
							<div class='col-7 col-sm-6 col-lg-3'>
								{{Form::select('displayQty', $displayQty, null , ['class'=>'form-control','id'=>'displayQty'])}}
							</div>
						@endif
					</div>

					@include('inc.result_info')

					<div class='col-12 text-center font-weight-bold mt-2 mb-2'>
						<nav aria-label="Top pagination navigation" class="d-inline-block text-center">
							<span class='d-inline-block text-center'>{{$restaurants->onEachSide(1)->links()}}</span>
						</nav>
					</div>

					<ul class='row restaurants'>
						@foreach($restaurants as $restaurant)
							@include('inc.restaurant', ['restaurant' => $restaurant])
						@endforeach
					</ul>
					<div class='row'>
						<div class='col-12 text-center mt-3 mb-4'>
							<nav  aria-label="Bottom pagination Navigation" class="d-inline-block text-center">
								<span class='d-inline-block text-center'>{{$restaurants->onEachSide(1)->links()}}</span>
							</nav>
						</div>
					</div>

				@else
					<div class="jumbotron" style='background:#fff;'>
						<h3 class='text-center'> No restaurants available. </h3>
					</div>
				@endif
			</div>
		</div>
	</div>

	
	


@endsection

@section('style')
<link rel="stylesheet" href="{{mix('css/vendor/jquery.simpler-sidebar.css')}}">
<link rel="stylesheet" href="{{mix('css/filter.css')}}">
@endsection

@section('script')
{{-- <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script> --}}
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="{{mix('js/jquery.raty.js')}}"></script>
<script src="{{asset('js/jquery.simpler-sidebar.min.js')}}"></script>

{{-- <script src="mix(/node_modules/'simpler-sidebar/dist/jquery.simpler-sidebar.min.js"></script> --}}
<script>
    $(document).ready(function(){
        
		//Swap one css class with another on the given element
		function swapClass(element,addClass,removeClass)
		{

			element.removeClass(removeClass);
			element.addClass(addClass);
		}

		//Check query contain string to determine filter should be turn by default or not
		function isfilterOpen()
		{
			let field = 'filterOpen';
			let url = window.location.href;
			if(url.indexOf('?' + field + '=') != -1)
				return true;
			else if(url.indexOf('&' + field + '=') != -1)
				return true;
			return false;
		}
		
		$('.star-rating').raty({
             path:     "{{asset('/imgs/rating')}}",
            readOnly: true,
            numberMax: 5,
            score:    function(){
            return $(this).attr('data-score');
            }
        });
	
		// Sliding men filter menu
        let $mainSidebar = $( "#sidebar-main" );
        $mainSidebar.simplerSidebar( {
            align: "right",
            attr: "sidebar-main",
            selectors: {
                trigger: "#sidebar-main-trigger",
                quitter: ".quitter"
            },
            animation: {
                easing: "easeOutQuint"
            },
            init:(isfilterOpen() ? 'opened' : 'closed' )
        } );
	
		$(document).on('click','.filter-title',function(event){
			
			event.preventDefault();
			let nextFilterOPtion = $(this).next("ul");
			$('.filter-options').not(nextFilterOPtion).each(function(){
				$(this).removeClass("d-block");
				$(this).addClass("d-none");
			});

			if($(this).not(nextFilterOPtion))
			{
				if(nextFilterOPtion.hasClass("d-none"))
					swapClass(nextFilterOPtion, 'd-block', 'd-none');
				else
					swapClass(nextFilterOPtion, 'd-none', 'd-block');
			}
		});

		$(document).on('click','.current-filter-btn',function(event){

			$this = $(this);
			if($this.hasClass('show-current-filter'))
			{
				$('.active-filters-wrapper').slideDown();
				$this.html('Hide Active Filters');
				swapClass($this,'hide-current-filter','show-current-filter');
				$this.attr('title','Hide selected Filters');
			}
			else
			{
				$('.active-filters-wrapper').slideUp();
				$this.html('Active Filters');
				swapClass($this,'show-current-filter','hide-current-filter');
				$this.attr('title','Show selected filters');
			}
			// $('.filters-result').removeClass('d-none');
		});
	});
	
</script>
@endsection