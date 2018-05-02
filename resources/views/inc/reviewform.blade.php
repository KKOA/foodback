{{-- Comment --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('comment', "Comment : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
    {!! Form::textarea('comment', $review->comment, ['rows' => 5,'class' => 'form-control','placeholder'=>'Restaurant comment','id'=>'article-ckeditor']) !!}
    <small>Min characters: 3</small>
    </div>
</div>

{{-- Rating --}}
<div class='form-group'>
    <div class='control-label col-sm-2'>
        {!! Form::label('rating', "Rating : ") !!} <span class="required">*</span>
    </div>
    <div class='col-sm-9'>
        <input id='rating' class='form-control' name='rating' type="number" step="0.5" min='0.0' max='5.0' value='{{$review->rating}}'/>
        <small>Min: 0, Max: 5, only number</small>
    </div>
</div>
