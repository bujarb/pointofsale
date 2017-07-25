@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Products saled</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sale as $s)
                <tr>
                  <td>{{DB::table('products')->where('id',$s->product_id)->pluck('name')->first()}}</td>
                  <td>{{$s->product_price}}</td>
                  <td>{{$s->quantity}}</td>
                  <td>{{$s->total_price}} Eur</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="panel-footer"><a href="{{route('sales-page')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go back to sales page</a></div>
      </div>
    </div>
  </div>
@endsection
