<?php
  use \Illuminate\Support\Str;
?>
@if ($errors->any())
  <div class='row mt-3 mb-3'>
      <div class='col-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8'>
        <div class="card bg-danger">
          <div class="card-header">
              <h2 class="card-title text-center text-white">
                  <?php $error_count = count($errors->all());
                echo Str::plural('Error',$error_count);
                  ?>
            </h2>
          </div>
          <div class="card-body bg-white rounded-bottom">
              <p class="text-center">{{$error_count}} incorrect {{\Illuminate\Support\Str::plural('value',$error_count)}} submitted.<br>
                Please correct the {{\Illuminate\Support\Str::plural('field',$error_count)}} highlighted in red below and resubmit the form.
              </p>
          </div>
        </div>
    </div>
  </div>
@endif

@if(session('success'))
  <div class='row mt-3 mb-3'>
    <div class="col-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8">
      <div class="card bg-success">
        <div class="card-header">
          <h2 class="card-title text-center text-white">
            Success
          </h2>
        </div>
        <div class="card-body bg-white rounded-bottom">
          <h4>{{session('success')}}</h4>
        </div>
      </div>
    </div>
  </div>
@endif

@if(session('error'))
  <div class='col-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8'>
      <div class="offset-md-1 col-md-10">
      <div class="card bg-danger">
        <div class="card-header">
          <h2 class="card-title text-center text-white">
            Error
          </h2>
        </div>
        <div class="card-body bg-white rounded-bottom">
          <h4>{{session('error')}}</h4>
        </div>
      </div>
    </div>
  </div>
@endif