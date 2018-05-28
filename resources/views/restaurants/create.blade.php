<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Add a new restaurant">
    @overwrite

@section('title', ' - Create Restaurants')

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
            'text'=>'Add Restaurant <i class="glyphicon glyphicon-save"></i>'//,
            //   'class'=>'add-review'
            ]
        ];
    ?>
    @include('inc.restaurantform')
@endsection

