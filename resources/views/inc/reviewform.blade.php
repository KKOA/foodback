<div class='row'>
        <div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6'>
            {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal']) !!}

            <header class='formHeader'>
                <h3 class='text-center'>
                    {{-- {{$form['formHeader']}}<br>{{$restaurant->name}} --}}
                    {{$form['formHeader']}} review for <br>{{$restaurant->name}}
                </h3>
            </header>
            <hr>
                @if(isset($form['method']))
                    {{Form::hidden('_method',$form['method'])}}
                @endif
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
                    <?php 
                        $defaultRating = isset($review->rating) ? $review->rating : 0;
                    ?>
                    <div class='col-sm-9'>
                        <input id='rating' class='form-control input-rating-text' name='rating' type="number" step="1" min='0.0' max='5.0' value='{{$defaultRating}}'/>
    
                    {{-- </div>
                    <div class='col-sm-5'> --}}
                        <span class='input-rating-star' data-score={{$defaultRating}}></span>
                    </div>
                    <div class='col-sm-offset-2 col-sm-9'>
                        <small>Min: 0, Max: 5</small>
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-9'>
                        <a href='{{route('restaurants.show',[$restaurant->id])}}' link_to restaurants_path, class='btn btn-warning btn-lg pull-left' title='See all reviews'>
                            Cancel <i class='glyphicon glyphicon-remove-circle'></i>
                        </a>
                        {!! Form::button($form['submission']['text'], ['class' => 'btn btn-success btn-lg pull-right '.$form['submission']['class'] ,'type' => 'submit']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    
    <style>
        form
        {
            margin-top:30px;
            margin-bottom:30px;
            background:#eee;
            /* padding-top:30px; */
            padding-bottom:30px;
            border-radius:10px;
            border: 1px solid #ccc;
            /* box-shadow:  */
            /* 0 0 30px rgba(0,0,0,.15) inset, */
                      /* 0 6px 10px rgba(0,0,0,.15); */
            /* box-shadow: 
                      0 6px 10px rgba(0,0,0,.15); */
            -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),
             0 3px 1px -2px rgba(0,0,0,0.12),
              0 1px 5px 0 rgba(0,0,0,0.2);
        }

        

        .formHeader
        {
            background:#3c8dbc;
            /* background:#4464cc; */
            border-top-right-radius:10px;
            border-top-left-radius:10px;
            border-bottom:1px solid #aaa;
        }

        .formHeader > h3{
            color:white;
            font-family: Arvo;
            font-weight: bold;
            line-height: 1.2em;
            letter-spacing: 0.1em;
            margin-top:0px;
            /* margin-bottom:30px; */
            padding-top:20px;
            padding-bottom:20px;
            text-align: center;
            text-shadow:
            -2px -2px 0 #3c8dbc,
            2px -2px 0 #3c8dbc,
            -2px 2px 0 #3c8dbc,
            2px 2px 0 #3c8dbc,
            2px 3px 0 #ddd,
            3px 4px 0 #ddd;
            text-align: center;
        }

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


        /*  */

        
    </style>
    