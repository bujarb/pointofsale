@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Products sold</h3>
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
                @foreach ($s->cart as $cart)
                  <tr>
                    <td>{{DB::table('products')->where('id','=',$cart->product_id)->pluck('name')->first()}}</td>
                    <td>{{$cart->product_price}} Eur</td>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$cart->total_price}}</td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>

          </table>
        </div>
        <div class="panel-footer">
          <a href="{{route('invoice-for-sale',$id)}}">Download invoice</a>
          <div class="col-md-2 pull-right">
            <strong>{{$total}}</strong> Euro
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2 col-md-offset-5">
      <a href="{{route('sales-register-page')}}" class="btn btn-info back">Back to sales register page</a>
    </div>
  </div>
@endsection
