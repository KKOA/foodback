<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Add a new review">
    @overwrite

@section('title', ' - Create Review')

@section('content')

<h3 class='text-center'>Create Review for {{$restaurant->name}}</h3>
<?php //dd($review->restaurant->first()->name); ?>
<div class='row'>
	<div class='col-sm-12'>
    {!! Form::model($restaurant, ['route' => ['restaurants.reviews.store', $restaurant->id],'class'=>'form-horizontal']) !!}
        @include('inc.reviewform')
        <div class='form-group'>
            <div class='col-sm-offset-2 col-sm-9'>
                <a href='{{route('restaurants.show',[$restaurant->id])}}' link_to restaurants_path, class='btn btn-warning btn-lg pull-left' title='See all reviews'>
                    Cancel <i class='glyphicon glyphicon-remove-circle'></i>
                </a>
                {!! Form::button('Add Review <i class="glyphicon glyphicon-save"></i>', ['class' => 'btn btn-success btn-lg pull-right add-review','type' => 'submit']) !!}
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>

@endsection

