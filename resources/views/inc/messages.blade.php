
@if ($errors->any())
  <div class='row'>
      <div class='col-md-offset-1 col-md-10'>
        <div class="panel panel-danger error-panel">
          <div class="panel-heading">
              <h2 class="panel-title text-center">
                  <?php $error_count = count($errors->all());
                  echo str_plural('Error',$error_count);
                  ?>
            </h2>
          </div>
          <div class="panel-body">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                  @endforeach
              </ul>        
          </div>
        </div>
    </div>
  </div>
@endif

@if(session('success'))
  <div class='row'>
    <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-success success-panel">
        <div class="panel-heading">
          <h2 class="panel-title text-center">
            Success
          </h2>
        </div>
        <div class="panel-body">
          <h4>{{session('success')}}</h4>
        </div>
      </div>
    </div>
  </div>
@endif

@if(session('error'))
  <div class='row'>
      <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-danger error-panel">
        <div class="panel-heading">
          <h2 class="panel-title text-center">
            Error
          </h2>
        </div>
        <div class="panel-body">
          <h4>{{session('error')}}</h4>
        </div>
      </div>
    </div>
  </div>
@endif