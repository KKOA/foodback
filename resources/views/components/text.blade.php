<?php
    // dd($fieldParams);
    array_set($fieldParams,'label', ucfirst($fieldParams['label'] ?? $fieldParams['name']));
?>
<div class="form-group {{ $errors->has(array_get($fieldParams,'name'))? 'has-error':''}} row">
    {{-- Label --}}
    @include('components.label')
    <div class="col-md-8">

        <?php
        $attributes = [
             "class"=>"form-control ". ($errors->has(array_get($fieldParams,'name')) ? ' is-invalid' : '')
        ]; 

        foreach($fieldParams as $key => $value)
        {
            if($key === 'name' || $key === 'value')
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
        {!! Form::text(array_get($fieldParams,'name'), array_get($fieldParams,'value'), $attributes) !!}

        @if ($errors->has(array_get($fieldParams,'name')))
            @include('components.errors')

        @elseif(array_get($fieldParams,'info')) 
            @include('components.info')
        @endif
        

    </div>
</div>


