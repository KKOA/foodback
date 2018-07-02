
@if ($errors->any())
  <div class='row mt-3 mb-3'>
      <div class='offset-md-1 col-md-10'>
        <div class="card bg-danger">
          <div class="card-header">
              <h2 class="card-title text-center text-white">
                  <?php $error_count = count($errors->all());
                  echo str_plural('Error',$error_count);
                  ?>
            </h2>
          </div>
          <div class="card-body bg-white rounded-bottom">
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
  <div class='row mt-3 mb-3'>
    <div class="offset-md-1 col-md-10">
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
  <div class='row mt-3 mb-3'>
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