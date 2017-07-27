@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Products sold today - Daily Report</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Paid</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sales as $sale)
                @foreach ($sale->cart as $cart)
                  <tr>
                    <td>{{DB::table('products')->where('id','=',$cart->product_id)->pluck('name')->first()}}</td>
                    <td>{{$cart->product_price}} Eur</td>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$cart->total_price}}</td>
                    <td>{{$sale->payment_method}}</td>
                    <td>{{$sale->paid == 1 ? 'Paid' : 'Not Paid'}}</td>
                    <td>{{$sale->time}}</td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-md-6">
              <a href="{{route('sales-register-page')}}">Back to sale register page</a>
            </div>
            <div class="col-md-2 pull-right">
              <a href="{{route('daily-pdf-report')}}">Download pdf</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
