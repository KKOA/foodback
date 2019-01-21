<div class='control-label col-md-3 text-md-right'>
    <label class="col-form-label" for='{{array_get($fieldParams,'name')}}'>
        {{array_get($fieldParams,'label')}}
        {{-- Required --}}
        {!!array_get($fieldParams,'required', false )? "<span class='required'>*</span>" : ''!!}
    </label>
</div>