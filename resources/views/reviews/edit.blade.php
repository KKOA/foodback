<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Edit review">
    @overwrite

@section('title')
    Edit your review for {{$review->restaurant->name}}
@endsection

@section('content')

<?php 
$restaurant = $review->restaurant; 

$form = [
        'formHeader'=>"Edit",
        'url'=> ['restaurants.reviews.update', $restaurant->id,$review->id],
        'method'=>'PATCH',
        'submission' => [
          'text'=>'Update <i class="fas fa-save"></i>',
          'class'=>'edit-review'
        ]
];

?>

@include('inc.reviewform')
@endsection


@section('script')
<script src="{{mix('js/jquery.raty.js')}}"></script>
<script>
   $(document).ready(function(){

       function greaterThanMax(input,max)
        {
            return input > max;
        }

        function lessThanMin(input,min)
        {
            return input < min;
        }

        function setRatingText(value)
        {
            $(".input-rating-text").val(value);
        }

        function setRatingStar(value)
        {
            $(".input-rating-star").attr("data-score", value); //Update data-score attribute
            $(".input-rating-star").raty("score", value);  // Update star selected
        }


        $(document).on("keyup change",".input-rating-text",function(event)
        {
            let $this = $(this);
            const MAX_RATING = parseInt($this.attr('max'));
            const MIN_RATING = parseInt($this.attr('min'));
            let currentRating = parseInt($this.val());

            //Not a number
            if(isNaN(currentRating))
            {
                //setRatingStar(MIN_RATING);
                currentRating = MIN_RATING;
                //setRatingText(currentRating);
            }

            //Prevent user enter value greater than max
            if(currentRating > MAX_RATING)
            {
                currentRating = MAX_RATING;
                setRatingText(currentRating);
            }

            //Prevent user enter value greater than max
            if(currentRating < MIN_RATING)
            {
                currentRating = MIN_RATING;
                setRatingText(currentRating);
            }

            setRatingStar(currentRating);
        });

        $(document).on("click",".input-rating-clear",function(event)
        {
            const MIN_RATING = parseInt($('.input-rating-text').attr('min'));
            $('.input-rating-star').raty('cancel');
            setRatingStar(MIN_RATING);
            setRatingText(MIN_RATING);
        });

        $(".input-rating-star").raty({
            click : function(score,event)
            {
                setRatingText(score);
                setRatingStar(score);
            },
            numberMax:5,
            path:     "{{asset('/imgs/rating')}}",
            start:0.0 //set default starting value
        });


        $(document).on("click",".input-rating-reset",function(event)
        {
            $('.input-rating-star').raty('click', {{ json_encode($review->rating)}}); 
        });

    });
</script>
@endsection

