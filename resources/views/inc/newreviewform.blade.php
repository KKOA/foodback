<div class='row'>
	<div class='col-sm-12'>
        {!! Form::model($restaurant, ['route' => $form['url'],'class'=>'form-horizontal']) !!}
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
    .input-rating-text-old
    {
        display: inline-block;
        /* width: 100%; */
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        margin-right:20px;
    }
</style>
