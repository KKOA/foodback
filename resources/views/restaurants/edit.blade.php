<!-- inherit from app blade.php -->
@extends('layouts.master')

@section('meta')
    <meta name="description" content="Update an existing restaurant">
    @overwrite

@section('title', ' - Edit Restaurants')

@section('content')

<h3 class='text-center'>Edit Restaurant</h3>
<div class='row'>
	<div class='col-sm-12'>
    {!! Form::model($restaurant, ['route' => ['restaurants.update', $restaurant->id],'class'=>'form-horizontal']) !!}
        @include('inc.restaurantform')
        <div class='form-group'>
                {{--  {{Form::hidden('_method','PUT')}}  --}}
                {{Form::hidden('_method','PATCH')}}
            </div>
        <div class='form-group'>
            <div class='col-sm-offset-2 col-sm-9'>
                    <a href='{{route('restaurants.show',[$restaurant->id])}}' link_to restaurants_path, class='btn btn-primary btn-lg pull-left' title='See all restaurants'>
                            Cancel <i class='glyphicon glyphicon-remove-circle'></i>
                    </a>
                {!! Form::button('Update Restaurant <i class="glyphicon glyphicon-save"></i>', ['class' => 'btn btn-success btn-lg pull-right','type' => 'submit']) !!}
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>

@endsection
