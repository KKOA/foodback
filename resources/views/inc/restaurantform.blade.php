{{--  Name --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('name', "Name : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
        {!! Form::text('name', $restaurant->name, ['class' => 'form-control','placeholder'=>'E.g. Lee Chinese', 'autofocus'=>true]) !!}
    </div>
</div>

{{-- Description --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('description', "Description : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
    {!! Form::textarea('description', $restaurant->description, ['rows' => 10,'class' => 'form-control','placeholder'=>'Restaurant description','id'=>'article-ckeditor']) !!}
    </div>
</div>

{{-- Address1 --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('address1', "Address1 : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
    {!! Form::text('address1', $restaurant->address1, ['rows' => 10,'class' => 'form-control','placeholder'=>'200 Cheam Road']) !!}
    </div>
</div>

{{-- Address2 --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('address2', "Address2 : ") !!}
    </div>
    <div class='col-sm-9'>
    {!! Form::text('address2', $restaurant->address2, ['rows' => 10,'class' => 'form-control','placeholder'=>'Sparcells']) !!}
    </div>
</div>

{{-- City --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('city', "City : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
    {!! Form::text('city', $restaurant->city, ['rows' => 10,'class' => 'form-control','placeholder'=>'Bristol']) !!}
    </div>
</div>

{{-- County --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('county', "County : ") !!}
    </div>
    <div class='col-sm-9'>
    {!! Form::text('county', $restaurant->county, ['rows' => 10,'class' => 'form-control','placeholder'=>'Wiltshire']) !!}
    </div>
</div>

{{-- Postcode --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('postcode', "Postcode : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
    {!! Form::text('postcode', $restaurant->postcode, ['rows' => 10,'class' => 'form-control','placeholder'=>'EN1 DG2']) !!}
    </div>
</div>