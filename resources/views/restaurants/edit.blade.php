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
            'text'=>'Add Restaurant <i class="glyphicon glyphicon-save"></i>'//,
            //   'class'=>'add-review'
            ]
        ];
    ?>
    @include('inc.restaurantform')
@endsection
