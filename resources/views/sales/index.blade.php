@extends('layouts.main')

@section('content')
<div class="row myrow">
  <div class="row">
    <div class="col-md-3">
      <h4><i class="fa fa-barcode"></i> Products</h4>
    </div>
    <div class="col-md-5">
      <div class="row">
        <div class="col-md-7">
          <input type="text" class="form-control"/>
        </div>
        <div class="col-md-3">
          <button class="btn btn-info btn-block">Search</button>
        </div>
      </div>
    </div>
    <div class="col-md-2 pull-right">
      <select class="form-control" name="select" id="select">
        <option value="all">All</option>
        <option value="paid">Paid</option>
        <option value="notpaid">Not Paid</option>
      </select>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th>Expand</th>
          <th>Payment Method</th>
          <th>Paid</th>
          <th>Total Price</th>
          <th>Costumer</th>
          <th>Created At</th>
          <th>Time</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sale)
          <tr>
            <td><a href="{{route('sale-single',$sale->id)}}" class="btn btn-info btn-block">Expand</a></td>
            <td>{{$sale->payment_method}}</td>
            <td>{{$sale->paid == 1 ? 'Paid' : "Not Paid"}}</td>
            <td>{{$sale->total_price}} Eur</td>
            <td>{{$sale->costumer}}</td>
            <td>{{$sale->created_at->format('D M')}}</td>
            <td>{{$sale->time}}</td>
            <td><button class="btn btn-danger btn-block">Delete</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>
{{$sales->links()}}
@endsection

@section('script')

@endsection
