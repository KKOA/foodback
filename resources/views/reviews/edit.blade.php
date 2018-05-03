<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Edit review">
    @overwrite

@section('title', ' - Edit Review')

@section('content')

<?php 
$restaurant = $review->restaurant->first(); ?>
{{--$review->restaurant->first()->name--}}
<h3 class='text-center'>Edit Review for {{$review->restaurant->first()->name}}</h3>
<div class='row'>
	<div class='col-sm-12'>
    {!! Form::model($restaurant, ['route' => ['restaurants.reviews.update', $restaurant->id,$review->id],'class'=>'form-horizontal']) !!}
    {{Form::hidden('_method','PATCH')}}
        @include('inc.reviewform')
        <div class='form-group'>
            <div class='col-sm-offset-2 col-sm-9'>
                <a href='{{route('restaurants.show',[$restaurant->id])}}' link_to restaurants_path, class='btn btn-warning btn-lg pull-left' title='See all reviews'>
                    Cancel <i class='glyphicon glyphicon-remove-circle'></i>
                </a>
                {!! Form::button('Update Review <i class="glyphicon glyphicon-save"></i>', ['class' => 'btn btn-success btn-lg pull-right edit-review','type' => 'submit']) !!}
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

