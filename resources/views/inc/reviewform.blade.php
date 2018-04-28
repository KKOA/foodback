{!! Form::open(['route' => ['restaurants.reviews.store',$restaurant->id],'method'=>'post','class'=>'form-horizontal', 'id'=>'reviewform']) !!}
<h3 class='text-center'>New Review</h3>
    {{-- Comment --}}
    <div class='form-group'>
        <div class='control-label col-sm-2'>
            {!! Form::label('comment', "Comment : ") !!} <span class="required">*</span>
        </div>
        <div class='col-sm-9'>
        {!! Form::textarea('comment', '', ['rows' => 5,'class' => 'form-control','placeholder'=>'Restaurant comment','id'=>'article-ckeditor']) !!}
        </div>
    </div>
    
    {{-- Rating --}}
    <div class='form-group'>
        <div class='control-label col-sm-2'>
            {!! Form::label('rating', "Rating : ") !!} <span class="required">*</span>
        </div>
        <div class='col-sm-9'>
            <input id='rating' class='form-control' name='rating' type="number" step="0.5" min='0.0' max='5.0'/>
        </div>
    </div>

    {!! Form::button('Add Review <i class="glyphicon glyphicon-save"></i>', ['class' => 'btn btn-success add-review','type' => 'submit']) !!}

{!! Form::close() !!}

<style>
        #reviewform
        {
            border: solid 1px #ddd;
            background: #ddd;
            /* padding-top: 20px; */
            padding-bottom: 20px;
            border-radius: 10px;

        }

        #reviewform textarea
        {
            margin-top:7px;
        }
        .add-review
        {
            margin-left:5%;
            margin-right:5%;
            width: 90%;
        }
    </style>