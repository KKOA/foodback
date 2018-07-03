<div class='row'>
    <div class='col-12 offset-md-1 col-md-10 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6'>
        {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal restaurant-form','files'=>'true']) !!}
            <header class='formHeader'>
                <h2 class='text-center text-white'>
                    {{$form['formHeader']}} restaurant
                </h3>
            </header>

            @if(isset($form['method']))
                {{Form::hidden('_method',$form['method'])}}
            @endif

            {{--  Name --}}
            <div class='form-group row '>
                {{-- <div class='control-label col-sm-3'> --}}
                <div class='col-md-3 text-md-right'>
                    {!! Form::label('name', 'Name : ',['class'=>'col-form-label']) !!} 
                    <span class="required">*</span>
                </div>
                <div class='col-md-8'>
                    {!! Form::text('name', $restaurant->name, ['class' => 'form-control','placeholder'=>'E.g. Lee Chinese', 'autofocus'=>true]) !!}
                </div>
            </div>

            {{-- Description --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('description', "Description : ",['class'=>'col-form-label']) !!} <span class="required">*</span>
                </div>
                <div class='col-md-8'>
                {{-- {!! Form::textarea('description', $restaurant->description, ['rows' => 10,'class' => 'form-control','placeholder'=>'Restaurant description','id'=>'article-ckeditor']) !!} --}}
                {!! Form::textarea('description', $restaurant->description, ['rows' => 10,'class' => 'form-control','placeholder'=>'Restaurant description','id'=>'description']) !!}
                </div>
            </div>

            {{-- Address1 --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('address1', "Address1 : ",['class'=>'col-form-label']) !!} <span class="required">*</span>
                </div>
                <div class='col-md-8'>
                {!! Form::text('address1', $restaurant->address1, ['rows' => 10,'class' => 'form-control','placeholder'=>'200 Cheam Road']) !!}
                </div>
            </div>

            {{-- Address2 --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('address2', "Address2 : ",['class'=>'col-form-label']) !!}
                </div>
                <div class='col-md-8'>
                {!! Form::text('address2', $restaurant->address2, ['rows' => 10,'class' => 'form-control','placeholder'=>'Sparcells']) !!}
                </div>
            </div>

            {{-- City --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('city', "City : ",['class'=>'col-form-label']) !!} <span class="required">*</span>
                </div>
                <div class='col-md-8'>
                {!! Form::text('city', $restaurant->city, ['rows' => 10,'class' => 'form-control','placeholder'=>'Bristol']) !!}
                </div>
            </div>

            {{-- County --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('county', "County : ",['class'=>'col-form-label']) !!}
                </div>
                <div class='col-md-8'>
                {!! Form::text('county', $restaurant->county, ['rows' => 10,'class' => 'form-control','placeholder'=>'Wiltshire']) !!}
                </div>
            </div>

            {{-- Postcode --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('postcode', "Postcode : ",['class'=>'col-form-label']) !!} <span class="required">*</span>
                </div>
                <div class='col-md-8'>
                {!! Form::text('postcode', $restaurant->postcode, ['rows' => 10,'class' => 'form-control','placeholder'=>'EN1 DG2']) !!}
                </div>
            </div>

            
            {{-- Cuisine Type --}}
            <div class='form-group row justify-content-center'>
                <h4>Cuisine Type</h4>
                {{-- <div class='col-md-10 col-md-offset-1'> --}}
                <div class='center-offset-md-1 col-md-11'>
                    @foreach($cuisines as $cuisine)
                        <label class='cuisine' id='{{$cuisine->name}}' class='text-center'>
                            {{Form::checkbox('cuisines[]', $cuisine->id , $restaurant->cuisines->contains($cuisine->id))}}   
                            <span class="label-text">{{ $cuisine->name}}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Preview Image & cover_image text --}}

            <div class='form-group row align-items-center'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('preview_cover_image', "Preview image : ",['class'=>'col-form-label']) !!}
                </div>
                <div class='col-md-8'>
                    @if($restaurant->cover_image)
                        <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}"
                        id='imgPreview'>
                    @else
                        <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image avaliable" alt="No image avaliable" id='imgPreview'>
                    @endif
                </div>
            </div>

            {{-- cover_image --}}
            <div class='form-group row'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('cover_image', "Cover image : ",['class'=>'col-form-label']) !!}
                </div>
                <div class='col-md-8'>
                    <input type='file' name='cover_image' id='cover_image'>

                    <div><small>Image types only (jpg, png, gif)</small></div>
                    <a href="#" id="clear" class='btn btn-secondary'>Reset</a>
                </div>
            </div>
            <div class='form-group row'>
                {{-- <div class='col-sm-offset-2 col-sm-9'> --}}
                {{-- <div class='col-md-offset-1 col-md-10'> --}}
                {{-- <div class='col-12 offset-md-1 col-md-5 mb-3'> --}}

                @if(isset($form["cancel"]['parameter']))
                        <a href='{{route($form["cancel"]["url"], $form["cancel"]["parameter"])}}' link_to restaurants_path, class='btn btn-warning btn-lg center-offset-xs-1 col-11 center-offset-md-1 col-md-5 mb-3' title='See all restaurants'>
                                Cancel <i class='fas fa-times'></i>
                        </a>
                    @else
                        <a href='{{route($form["cancel"]["url"])}}' link_to restaurants_path, class='btn btn-warning btn-lg center-offset-xs-1 col-11 center-offset-md-1 col-md-5 mb-3' title='See all restaurants'>
                                Cancel <i class='fas fa-times'></i>
                        </a>
                    @endif
                {{-- </div> --}}
                {{-- <div class='col-12 offset-md-1 col-md-5 mb-3' > --}}
                    {!! Form::button($form['submission']['text'], ['class' => 'btn btn-success btn-lg center-offset-xs-1 col-11 center-offset-md-1 col-md-5 mb-3','type' => 'submit']) !!}
                {{-- </div> --}}
            </div>
        {!! Form::close() !!}
    </div>
</div>