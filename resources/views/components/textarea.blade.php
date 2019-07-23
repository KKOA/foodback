<?php
    // dd($fieldParams);
    Arr::set($fieldParams,'label', ucfirst($fieldParams['label'] ?? $fieldParams['name']));
?>
<div class="form-group {{ $errors->has(Arr::get($fieldParams,'name'))? 'has-error':''}} row">
    {{-- Label --}}
    @include('components.label')

    <div class="col-md-8">
        <?php
        $attributes = [
                "class"=>"form-control ". ($errors->has(Arr::get($fieldParams,'name')) ? ' is-invalid' : '')
        ]; 

        foreach($fieldParams as $key => $value)
        {
            if($key === 'name' || $key === 'value' || $key === 'label')
                    continue;
            
            if($key === 'class')
            {
                $value = implode(" ",$value);
                
                $attributes[$key] = $attributes[$key] ." ".$value; 
                continue;
            }    
            $attributes[$key] = $value;

        }
        ?>

        {!! Form::textArea(Arr::get($fieldParams,'name'), Arr::get($fieldParams,'value'), $attributes) !!}

        @if ($errors->has(Arr::get($fieldParams,'name')))
            @include('components.errors')
        @elseif(Arr::get($fieldParams,'info'))
            @include('components.info')
        @endif
        
    </div>
</div>
