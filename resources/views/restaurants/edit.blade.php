<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Update an existing restaurant">
    @overwrite

@section('title', ' - Edit Restaurants')

@section('content')
    <?php
        $form = [
            'formHeader'=>"Edit",
            'url'=> ['restaurants.update', $restaurant->id],
            'method'=>'PATCH',
            'cancel'=>
            [ 
                'url' =>'restaurants.show',
                'parameter'=>$restaurant->id,
                'title'=>'View '
            ],
            'submission' => [
            'text'=>'Update <i class="fas fa-save"></i>',
              'class'=>'edit-restaurant'
            ]
        ];
    ?>
    @include('inc.restaurantform')
@endsection


@section('script')
<script>
    $(document).ready(function(){

        // Referneces
        let imagePreview = document.getElementById('imgPreview').src;
        let control = $("#cover_image"), clearBn = $("#clear");

        // Setup the clear functionality
        clearBn.on("click", function(){
            control.replaceWith( control.val('').clone( true ) );
            document.getElementById('imgPreview').src = imagePreview;
        });

        // Some bound handlers to preserve when cloning
        control.on({
            change: function(){ console.log( "Changed" ) },
            focus: function(){ console.log(  "Focus"  ) }
        });

        function readURL(input) 
        {

            if (input.files && input.files[0]) 
            {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result);
                }

            reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cover_image").change(function() {
            readURL(this);
        });
    });
</script>
@endsection