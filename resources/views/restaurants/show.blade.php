<!-- inherit from app blade.php -->
@extends('layouts.master')

@section("title")
    {{$restaurant->name}}
@endsection

@section('content')
    <div class='row mt-3'>
        <a href='{{route('restaurants.index')}}' link_to restaurants_path, class='btn btn-primary' title='See all restaurants' id='view-restaurants'>
            <i class="fas fa-hand-point-left"></i> View Restaurants
        </a>
    </div>
    <div class='row'>
        <div class='restaurant col-md-7'>
            {{-- Name --}}
            <h2 class='text-center restaurant-name'>{{$restaurant->name}}</h2>
            {{-- Cover Image --}}
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
                <span class="more"></span>
                @if($restaurant->cover_image)
                    <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}">
                @else
                    <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image available" alt="No image available">
                @endif
            </a>
            {{-- Adress --}}
            <div class='address'>
                <div class='text-center'>{{$restaurant->fullAddress()}}</div>
            </div> 
            <ul class='more-info row'>
                <li class="clearfix col-sm-11 center-offset-sm-1">
                    <div class="field-name">Cuisine Type :</div>
                    <div class='cuisine-value'>

                        @if($restaurant->cuisines()->count() > 0)
                            {{$restaurant->cuisines()->get()->implode('name',', ')}}
                        @else
                            Not specified
                        @endif
                    </div>
                </li>
                <li class="clearfix col-sm-5 center-offset-sm-1">
                    <span class="float-left field-name">Parking :</span>
                    <span class="qty float-right">Yes</span>
                </li>
                <li class="clearfix col-sm-5 center-offset-sm-1">
                    <span class="float-left field-name">WiFi :</span>
                    <span class="qty float-right">Yes</span>
                </li>
                <li class="clearfix col-sm-5 center-offset-sm-1">
                    <span class="float-left field-name">Outdoor Seating :</span>
                    <span class="qty float-right">No</span>
                </li>
                <li class="clearfix col-sm-5 center-offset-sm-1">
                    <span class="float-left field-name">Takeaway :</span>
                    <span class="qty float-right">No</span>
                </li>
                <li class="clearfix col-sm-5 center-offset-sm-1">
                    <span class="float-left field-name">Delivery :</span>
                    <span class="qty float-right">No</span>
                </li>
                <li class="clearfix col-sm-5 center-offset-sm-1">
                    <span class="float-left field-name">Serving Times : </span>
                    <span class="qty float-right">No</span>
                </li>
            </ul>

            <div class='row'>
                <div class='col-12'>
                    <h3>DESCRIPTION</h3>
                    {!!$restaurant->description!!}
                </div>
            </div>

            @if(Auth::check() && Auth::user()->id == $restaurant->user_id)
            <div class="row mt-2 mb-2">
                <div class='col-12 col-md-6 col-xl-5'>
                    <a href='{{route('restaurants.edit',[$restaurant->id])}}' id='edit-restaurant' class='btn btn-primary' title='Modify current restaurant'>
                        Edit Restaurant <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>

                <div class='col-12 col-md-6 offset-xl-2 col-xl-5'>
                    {!!Form::open(['action'=>['RestaurantController@destroy',$restaurant->id],'method'=>'POST','class'=>'delete'])!!}
                        {!! Form::button('Delete Restaurant <i class="fas fa-trash-alt"></i>', ['id'=>'delete-restaurant','class' => 'btn btn-danger','type' => 'submit']) !!}
                        {{Form::hidden('_method','DELETE')}}
                    {!!Form::close()!!}
                </div>
            </div>
            @endif
            <hr>
            {{--  Reviews --}}
            @include('inc.reviews')
        </div>
        <div class='col-md-4' style='padding:10px;' >
                {{-- <%= render 'layouts/map' %> --}}
                {{--@include('inc.map')--}}
                <%= render 'layouts/owner' %>
                <%= render 'layouts/search_form' %>
        </div>
    </div>
    {{-- Delete restaurant Modal --}}
    @include('inc.deleteRestaurantModal')
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

        $(document).on('click','.delete' , function(e){
        // $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
            e.preventDefault();
            var $form=$(this);
            // $('#confirm').modal({ backdrop: 'static', keyboard: false })
            $('#confirm').modal({ backdrop: true, keyboard: true })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });
    });
</script>
@endsection