<div class="invalid-feedback" role="alert">
    <div class="invalid-feedback-content font-weight-bold">
        <i class="fas fa-exclamation-circle fa-lg"></i>
        {{ $errors->first(Arr::get($fieldParams,'name')) }}
    </div>
</div>