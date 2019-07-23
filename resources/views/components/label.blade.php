<div class='control-label col-md-3 text-md-right'>
    <label class="col-form-label" for='{{Arr::get($fieldParams,'name')}}'>
        {{Arr::get($fieldParams,'label')}}
        {{-- Required --}}
        {!!Arr::get($fieldParams,'required', false )? "<span class='required'>*</span>" : ''!!}
    </label>
</div>