
{{--$restaurant->reviews--}}
<?php $reviews = $restaurant->reviews->sortByDesc('updated_at'); 
    //dd($reviews->sortBy('updated_at'));
?>
@if($reviews->count() > 0)

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
    <p>No reviews avaliable for this restaurant</p> 
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
<!-- <div id='review<%= review.id %>'class='review'>
      <p>
      <strong>Comment:</strong>
      <%= review.comment %>
      </p>

      <p>
      <strong>Rating:</strong>
      <%= review.rating %>
      </p>
    </div> -->