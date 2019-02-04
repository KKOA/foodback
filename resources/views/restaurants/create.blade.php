<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Add a new restaurant">
    @overwrite

@section('title', ' Add your restaurant')

@section('content')
    <?php
        $form = [
            'formHeader'=>"Create",
            'url'=> ['restaurants.store', $restaurant->id],
            'cancel'=> [
                'url' =>'restaurants.index',
                'title'=>'See all restaurants'
            ],
            'submission' => [
            'text'=>'Save <i class="fas fa-save"></i>',
              'class'=>'add-restaurant'
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
                    console.log('wtf');
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
<script src="{{mix('js/form.js')}}"></script>
@endsection

