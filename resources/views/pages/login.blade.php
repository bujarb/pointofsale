@extends('layouts.login')

@section('content')
  <div class="row ">
  <div class="col-md-4 col-md-offset-4 box">
    <div class="well"><h4 class="text-center">Point of Sale</h4></div>
    <img class="img-circle myimg" src="http://cdn3.volusion.com/swkxh.awrcc/v/vspfiles/photos/ught-iron-house-letter-p-LET-P-2.jpg?1447069989" width="90"/>
      <form action="{{route('login')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
          <input type="text" class="form-control logininput" placeholder="Username" name="email" id="email"/>
          <input type="password" class="form-control logininput" placeholder="Password" name="password" id="password"/>
        </div>
      <button class="btn btn-default btn-lg btn-block mybtn">Login</button>
      </form>
  </div>
</div>
@endsection
