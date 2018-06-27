<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Add a new review">
    @overwrite

@section('title', ' - Create Review')

@section('content')

<?php 
$form = [
        'formHeader'=>"Create",
        'url'=> ['restaurants.reviews.store', $restaurant->id],
        'submission' => [
          'text'=>'Add Review <i class="fas fa-save"></i>',
          'class'=>'add-review'
        ]
];

?>

@include('inc.reviewform')

@endsection

@section('script')
<script src="{{mix('js/jquery.raty.js')}}"></script>
<script>
    $(document).ready(function(){

        $(document).on("blur",".input-rating-text",function(event)
        {
            $this = $(this);
            var currentRating = parseInt($this.val());

            //Prevent user enter value greater than max
            var maxRating = parseInt($this.attr("max"));
            if(currentRating > maxRating)
            {
                $this.val(maxRating);
            }

            //Prevent user enter value greater than max
            var minRating = parseInt($this.attr("min"));
            if(currentRating < minRating)
            {
                $this.val(minRating);
            }

            $(".input-rating-star").attr("data-score", currentRating); //Update data-score attribute
            $(".input-rating-star").raty("score",currentRating);  // Update star selected

        });

        $(".input-rating-star").raty({
            cancel:         true,
            cancelHint:     'Reset to previous value',
            cancelOff:    "reset.png",
            cancelOn:    "reset.png",
            cancelPlace: "left",
            click : function(score,event)
            {
                $(".input-rating-text").val(score);
                $(".input-rating-star").attr("data-score", score);
            },
            numberMax:5,
            path:     "{{asset('/imgs/rating')}}",
            start:0.0 //set default starting value
        });

        $(document).on("click",".raty-cancel",function(event)
        {
            var oldRating = {{ json_encode($review->rating)}};
            oldRating = oldRating ? oldRating :  0; // Set value to 0 if value is consider falsy
            $(".input-rating-text").val(oldRating); // Update input rating field

            $(".input-rating-star").attr("data-score", oldRating); //Update data-score attribute
            $(".input-rating-star").raty("score",oldRating);  // Update star selected

        });
    });
</script>
@endsection