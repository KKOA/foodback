<li id="restaurant{{$restaurant->id}}" class="offset-1 col-10 col-md-5 center-offset-md-1 restaurant">
        <div class="holder">
            <div class="prop-info">
                <h4 class="prop-title text-center">
                    <a href="{{route('restaurants.show',[$restaurant->id])}}">
                        {{$restaurant->name}}
                    </a>
                </h4>
            </div>
            <a class="overlay" title="View {{$restaurant->name}}" href="{{route('restaurants.show',[$restaurant->id])}}">
                <span class="more"></span>
                @if($restaurant->cover_image)
                    <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}">
                @else
                    <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image available" alt="No image available">
                @endif
            </a>
            <div class="prop-info">
                <ul class='more-info align-items-center'>
                    <li class="clearfix location">
                        <div class='address text-center'>
                                {{$restaurant->fullAddress()}}
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