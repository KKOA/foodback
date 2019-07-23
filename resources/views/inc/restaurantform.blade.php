<div class='row mt-4'>
    @if(isset($form["cancel"]['parameter']))
        <a href='{{route($form["cancel"]["url"], $form["cancel"]["parameter"])}}' link_to restaurants_path, class='btn btn-primary' title='See {{$restaurant->name}} restaurants'>
        <i class="fas fa-hand-point-left"></i> View {{$restaurant->name}} restaurant
        </a>
    @else
        <a href='{{route($form["cancel"]["url"])}}' link_to restaurants_path, class='btn btn-primary' title='See all restaurants'>
                <i class="fas fa-hand-point-left"></i> View restaurants
        </a>
    @endif
</div>

<div class='row mt-4 mb-4'>
    <div class='col-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8'>
        {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal restaurant-form','files'=>'true']) !!}
            <header class='form-Header bg-blue-header'>
                <h2 class='text-center pl-1 pr-1'>
                    {{$form['formHeader']}} restaurant
                </h2>
            </header>

            @if(isset($form['method']))
                {{Form::hidden('_method',$form['method'])}}
            @endif

                        
            {{--  Name --}}
            {!! Form::textGroup(
                [
                'id' => 'name',
                'name' => 'name',
                'value' => old('name')?? $restaurant->name,
                'placeholder'=>'E.g. Wild Thyme Cafe',
                'info'=>'Min 3 Characters'
            ], $errors) !!}

            {{-- Description --}}
            {!! Form::textAreaGroup(
                [
                'id' => 'description',
                'name' => 'description',
                'value' => old('description')?? $restaurant->description,
                'placeholder'=>'Restaurant Description',
                'row'=>5,
                'info'=>'Min 3 Characters'
            ], $errors) !!}


            {{-- Address1 --}}
            {!! Form::textGroup([
                'id' => 'address1',
                'name' => 'address1',
                'value' => old('address1')?? $restaurant->address1,
                'placeholder'=>'200 Cheam Road',
                
                // 'info'=>'Min 3 Characters'
            ],
             $errors) !!}

            {{-- Address2 --}}
            {!! Form::textGroup([
                'id' => 'address2',
                'name' => 'address2',
                'value' => old('address2')?? $restaurant->address2,
                'placeholder'=>'Sparcells'
                // ,
                // 'info'=>'Min 3 Characters'
            ],
             $errors) !!}

            {{-- City --}}
            {!! Form::textGroup([
                'id' => 'city',
                'name' => 'city',
                'value' => old('city')?? $restaurant->city,
                'placeholder'=>'Bristol',
                
                // 'info'=>'Min 3 Characters'
            ],
             $errors) !!}

            {{-- County --}}
            {!! Form::textGroup([
                'id' => 'county',
                'name' => 'county',
                'value' => old('county')?? $restaurant->county,
                'placeholder'=>'Wiltshire'
                // 
                // 'info'=>'Min 3 Characters'
            ],
             $errors) !!}

            {{-- Postcode --}}
            {!! Form::textGroup([
                'id' => 'postcode',
                'name' => 'postcode',
                'value' => old('postcode')?? $restaurant->postcode,
                'placeholder'=>'EN1 DG2',
                
                // 'info'=>'Min 3 Characters'
            ],
             $errors) !!}

            
            {{-- Cuisine Type --}}
            <h3 class='text-center'>Cuisine Type</h3>
            <div class='form-group row justify-content-center'>
                <div class='offset-md-1 col-md-10'>
                    @foreach($cuisines as $cuisine)
                        <label class='my-checkbox-label' id='{{$cuisine->name}}' class='text-center'>
                            {{Form::checkbox('cuisines[]', $cuisine->id , $restaurant->cuisines->contains($cuisine->id))}}   
                            <span class="label-text">{{ $cuisine->name}}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Preview Image & cover_image text --}}
            <h3 class='text-center'>Photo</h3>
            <div class='form-group row align-items-center'>
                <div class='control-label col-md-3 text-md-right'>
                    {!! Form::label('preview_cover_image', "Preview image : ",['class'=>'col-form-label']) !!}<br>
                    <label for='preview_cover_image' class='col-form-label'>Preview<br>Image</label>
                </div>

                <div class='col-md-8'>
                    @if($restaurant->cover_image)
                        <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}"
                        id='imgPreview'>
                    @else
                        <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image available" alt="No image available" id='imgPreview'>
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

                    <div><p><small>Image types only (jpg, png, gif)</small></p></div>
                    <a href="#" id="clear" class='btn btn-secondary'>Reset</a>
                </div>
            </div>
            <div class='form-group row'>

                @if(isset($form["cancel"]['parameter']))
            <a href='{{route($form["cancel"]["url"], $form["cancel"]["parameter"])}}' link_to restaurants_path, class='btn btn-secondary btn-lg center-offset-xs-1 col center-offset-md-1 mb-3' title='See {{$restaurant->name}} restaurants'>
                            Cancel <i class='fas fa-times'></i>
                    </a>
                @else
                    <a href='{{route($form["cancel"]["url"])}}' link_to restaurants_path, class='btn btn-secondary btn-lg center-offset-xs-1 col center-offset-md-1 mb-3' title='See all restaurants'>
                            Cancel <i class='fas fa-times'></i>
                    </a>
                @endif
                {!! Form::button($form['submission']['text'], ['class' => 'btn btn-success btn-lg center-offset-xs-1 col center-offset-md-1 mb-3','type' => 'submit']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>