

<?php $reviews = $restaurant->reviews->sortByDesc('updated_at'); 
?>
@if($reviews->count() > 0)

    
    <h3>
        <span class="no-of-reviews">
            {{$restaurant->reviews->count()}} {{$restaurant->name}} review{{$restaurant->reviews->count() > 1 ? 's': '' }}
        </span>
    </h3>
    <h4>  
        <span class="restaurant-avg-rating">
                <span title='average'>Average Rating : </span>
                <span class='star-rating' data-score={{$restaurant->reviews->avg('rating')}}></span>
                <span class='text-rating sr-only'>{{$restaurant->reviews->avg('rating')}}</span>
        </span>
    </h4>

    <a href='{{route('restaurants.reviews.create',[$restaurant->id])}}' id='write-restaurant' class='btn btn-primary' title='Write new review'>
        Write a Review <i class='glyphicon glyphicon-star'></i>
    </a>

    @foreach($reviews as $review)
        <div id='review{{$review->id}}' class="panel panel-default review">
            <div class="panel-heading">
                <div class='row'>
                    <div class='col-xs-12 col-sm-6'>
                        username
                    </div>
                    <div class='col-xs-12 col-sm-6 text-right'>
                        {{$review->updated_at}}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span class='star-rating' data-score={{$review->rating}}></span><span class='text-rating'> ( {{$review->rating}} )</span><br><br>
                {{$review->comment}}
            </div>
            <div class="panel-footer">
                {{--  --}}
                <div class='row'>
                <div class='col-xs-12 col-sm-6 col-lg-5'>
                        <a href='{{route('restaurants.reviews.edit',[$restaurant->id,$review->id])}}' id="edit-review{{$review->id}}" class='btn btn-primary review-btn' title='Modify this review'>
                            Edit Review <i class='glyphicon glyphicon-pencil'></i>
                        </a>
                    </div>
    
                    <div class='col-xs-12 col-sm-6 col-lg-offset-2 col-lg-5'>
                        {!!Form::open(['action'=>['ReviewController@destroy',$restaurant->id,$review->id],'method'=>'POST'])!!}
                            {!! Form::button('Delete Review <i class="glyphicon glyphicon-trash"></i>', ['id'=>"delete-review$review->id",'class' => 'btn btn-danger review-btn','type' => 'submit', 'title'=>'Delete this review']) !!}
                            {{Form::hidden('_method','DELETE')}}
                        {!!Form::close()!!}
                    </div>
                </div>
                {{--  --}}
            </div>
        </div>
    @endforeach
@else
    <h3>No reviews avaliable for this restaurant</h3> 
    <a href='{{route('restaurants.reviews.create',[$restaurant->id])}}' id='write-restaurant' class='btn btn-primary' title='Write new review'>
        Write a Review <i class='glyphicon glyphicon-star'></i>
    </a>
    
@endif

<style>
    .review
    {
        margin-top:20px;
    }

    .review-btn
    {
        width:100%;
        margin-top:10px;
        margin-bottom:10px;
    }
    </style>
