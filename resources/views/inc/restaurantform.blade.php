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