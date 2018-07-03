<div class='row'>

        <div class='col-12 offset-md-1 col-md-10 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6'>
            {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal review-form' ]) !!}

                <header class='formHeader'>
                    <h2 class='text-center text-white'>
                        {{-- {{$form['formHeader']}}<br>{{$restaurant->name}} --}}
                        {{$form['formHeader']}} review for <br>{{$restaurant->name}}
                    </h2>
                </header>
                
                @if(isset($form['method']))
                    {{Form::hidden('_method',$form['method'])}}
                @endif

                {{-- Comment --}}
                <div class='form-group row'>
                    <div class='control-label col-md-3 text-md-right'>
                        {!! Form::label('article-ckeditor', "Comment : ",['class'=>'col-form-label']) !!} <span class="required">*</span>
                    </div>
                    <div class='col-md-8'>
                    {!! Form::textarea('comment', $review->comment, ['rows' => 5,'class' => 'form-control','placeholder'=>'Restaurant comment','id'=>'article-ckeditor']) !!}
                    <small class='form-text'>Min characters : 3</small>
                    </div>
                </div>
    
                {{-- Rating --}}
                <div class='form-group row'>
                    <div class='control-label col-md-3 text-md-right'>
                        {!! Form::label('rating', "Rating : ",['class'=>'col-form-label']) !!} <span class="required">*</span>
                    </div>
                    <?php 
                        $defaultRating = isset($review->rating) ? $review->rating : 0;
                    ?>
                    <div class='col-md-8'>
                        <input id='rating' class='form-control input-rating-text' name='rating' type="number" step="1" min='0.0' max='5.0' value='{{$defaultRating}}'/>
    
                    {{-- </div>
                    <div class='col-sm-5'> --}}
                        <span class='input-rating-star' data-score={{$defaultRating}}></span>
                    </div>
                    <div class='center-offset-xs-1 offset-md-3 col-md-8'>
                        <small class='form-text'>Min : 0, Max : 5</small>
                    </div>
                </div>
                <div class='form-group row'>
                    {{-- <div class='col-xs-center-offset-1 col-sm-offset-1 col-sm-10'> --}}
                    <a href='{{route('restaurants.show',[$restaurant->id])}}' link_to restaurants_path, class='btn btn-warning btn-lg center-offset-xs-1 col-md center-offset-md-1 col-md-5 mb-3' title='See all reviews'>
                        Cancel <i class='fas fa-times'></i>  
                    </a>
                    {!! Form::button($form['submission']['text'], ['class' => 'btn btn-success btn-lg center-offset-xs-1 col center-offset-md-1 col-md-md-5 mb-3 '.$form['submission']['class'] ,'type' => 'submit']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    
    <style>
        .input-rating-text
        {
            display: inline-block;
            width: auto;
            margin-right:20px;
        }

        .input-rating-star
        {
            display:inline-block;
            padding:12px 6px;
        }

    </style>
    