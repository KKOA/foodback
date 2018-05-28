<div class='row'>
    <div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6'>
        {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal restaurant-form']) !!}
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