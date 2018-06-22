<div class='row'>
    <div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6'>
        {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal restaurant-form','files'=>'true']) !!}
            <header class='formHeader'>
                <h3 class='text-center'>
                    {{$form['formHeader']}} restaurant
                </h3>
            </header>

            @if(isset($form['method']))
                {{Form::hidden('_method',$form['method'])}}
            @endif

            {{--  Name --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('name', "Name : ") !!} <span class="required">*</span>
                </div>
                <div class='col-sm-8'>
                    {!! Form::text('name', $restaurant->name, ['class' => 'form-control','placeholder'=>'E.g. Lee Chinese', 'autofocus'=>true]) !!}
                </div>
            </div>

            {{-- Description --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('description', "Description : ") !!} <span class="required">*</span>
                </div>
                <div class='col-sm-8'>
                {!! Form::textarea('description', $restaurant->description, ['rows' => 10,'class' => 'form-control','placeholder'=>'Restaurant description','id'=>'article-ckeditor']) !!}
                </div>
            </div>

            {{-- Address1 --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('address1', "Address1 : ") !!} <span class="required">*</span>
                </div>
                <div class='col-sm-8'>
                {!! Form::text('address1', $restaurant->address1, ['rows' => 10,'class' => 'form-control','placeholder'=>'200 Cheam Road']) !!}
                </div>
            </div>

            {{-- Address2 --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('address2', "Address2 : ") !!}
                </div>
                <div class='col-sm-8'>
                {!! Form::text('address2', $restaurant->address2, ['rows' => 10,'class' => 'form-control','placeholder'=>'Sparcells']) !!}
                </div>
            </div>

            {{-- City --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('city', "City : ") !!} <span class="required">*</span>
                </div>
                <div class='col-sm-8'>
                {!! Form::text('city', $restaurant->city, ['rows' => 10,'class' => 'form-control','placeholder'=>'Bristol']) !!}
                </div>
            </div>

            {{-- County --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('county', "County : ") !!}
                </div>
                <div class='col-sm-8'>
                {!! Form::text('county', $restaurant->county, ['rows' => 10,'class' => 'form-control','placeholder'=>'Wiltshire']) !!}
                </div>
            </div>

            {{-- Postcode --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('postcode', "Postcode : ") !!} <span class="required">*</span>
                </div>
                <div class='col-sm-8'>
                {!! Form::text('postcode', $restaurant->postcode, ['rows' => 10,'class' => 'form-control','placeholder'=>'EN1 DG2']) !!}
                </div>
            </div>

            
            {{-- Category --}}
            <div class='form-group text-center'>
                <h4>Categories</h4>
                <div class='col-sm-10 col-sm-offset-1'>
                    @foreach($cuisines as $cuisine)
                        <label class='cuisine' id='{{$cuisine->name}}'>
                            {{Form::checkbox('cuisines[]', $cuisine->id , $restaurant->cuisines->contains($cuisine->id))}}   
                            <span class="label-text">
                                {{ $cuisine->name}}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
            <style>
                @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

                .category{
                    position: relative;
                    cursor: pointer;
                    /* color: #666; */
                    font-size: 16px;
                    margin-right:10px;
                    margin-bottom:5px;
                    letter-spacing: 1px;
                    /* border:1px solid #000; */
                    padding:5px;
                }

                input[type="checkbox"], input[type="radio"]{
                    position: absolute;
                    right: 9000px;
                }

                /*Check box*/
                input[type="checkbox"] + .label-text:before{
                    content: "\f096";
                    font-family: "FontAwesome";
                    speak: none;
                    font-style: normal;
                    font-weight: normal;
                    font-variant: normal;
                    text-transform: none;
                    line-height: 1;
                    -webkit-font-smoothing:antialiased;
                    width: 1em;
                    display: inline-block;
                    margin-right: 5px;
                }

                input[type="checkbox"]:checked + .label-text:before{
                    content: "\f14a";
                    /* color: #2980b9; */
                    color:#286090;
                    animation: effect 250ms ease-in;
                }

                input[type="checkbox"]:disabled + .label-text{
                    color: #aaa;
                }

                input[type="checkbox"]:disabled + .label-text:before{
                    content: "\f0c8";
                    color: #ccc;
                }

                @keyframes effect{
                    0%{transform: scale(0);}
                    25%{transform: scale(1.3);}
                    75%{transform: scale(1.4);}
                    100%{transform: scale(1);}
                }
            </style>


            {{-- Preview Image & cover_image text --}}

            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('cover_image', "Preview image : ") !!}
                </div>
                <div class='col-sm-8'>
                    @if($restaurant->cover_image)
                        <img src="{{asset('storage/upload/restaurants/'.$restaurant->id.'/'.$restaurant->cover_image)}}" alt="{{$restaurant->name.' cover image'}}"
                        id='imgPreview'>
                    @else
                        <img src="{{asset('imgs/placeholder/restaurant.png')}}" title="No image avaliable" alt="No image avaliable" id='imgPreview'>
                    @endif
                </div>
            </div>

            {{-- cover_image --}}
            <div class='form-group'>
                <div class='control-label col-sm-3'>
                    {!! Form::label('cover_image', "Cover image : ") !!}
                </div>
                <div class='col-sm-8'>
                {{-- {!! Form::text('postcode', $restaurant->postcode, ['rows' => 10,'class' => 'form-control','placeholder'=>'EN1 DG2']) !!} --}}
                    <input type='file' name='cover_image' id='cover_image' >

                    <div><small>Image types only (jpg, png, gif)</small></div>
                    <a href="#" id="clear" class='btn btn-default'>Reset</a>
                </div>
            </div>
            <style>
                input[type=file]
                {
                    margin:5px;
                    font-weight:bold;
                }
            </style>


            <div class='form-group'>
                {{-- <div class='col-sm-offset-2 col-sm-9'> --}}
                <div class='col-sm-offset-1 col-sm-10'>

                    @if(isset($form["cancel"]['parameter']))
                        <a href='{{route($form["cancel"]["url"], $form["cancel"]["parameter"])}}' link_to restaurants_path, class='btn btn-warning btn-lg pull-left' title='See all restaurants'>
                                Cancel <i class='glyphicon glyphicon-remove-circle'></i>
                        </a>
                    @else
                        <a href='{{route($form["cancel"]["url"])}}' link_to restaurants_path, class='btn btn-warning btn-lg pull-left' title='See all restaurants'>
                                Cancel <i class='glyphicon glyphicon-remove-circle'></i>
                        </a>
                    @endif
                    {!! Form::button($form['submission']['text'], ['class' => 'btn btn-success btn-lg pull-right','type' => 'submit']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>