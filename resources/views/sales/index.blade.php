@extends('layouts.main')

@section('content')
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
    <button class="btn btn-default" data-toggle="modal" data-target="#myModal">Add a new product</button>
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Quantity</th>
          <th>Total Prie</th>
          <th>Created At</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sale)
          @foreach ($sale->cart as $s)
            <tr>
              <td>{{DB::table('products')->where('id','=',$s->product_id)->pluck('name')->first() ? DB::table('products')->where('id','=',$s->product_id)->pluck('name')->first() : 'Not found in DB'}}</td>
              <td>{{$s->quantity}}</td>
              <td>{{$s->total_price}}</td>
              <td>{{$s->created_at->format('D d M')}}</td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a new product</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form id="userForm" method="post" action="{{route('product-store')}}">
              {{csrf_field()}}
              <div class="form-group">
                <label>Product SKU:</label>
                <input type="text" class="form-control" name="sku" id="sku"/>
              </div>
              <div class="form-group">
                <label>Product Name:</label>
                <input type="text" class="form-control" name="name" id="name"/>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="text" class="form-control" name="quantity" id="quantity"/>
              </div>
              <div class="form-group">
                <label>Product Price:</label>
                <input type="text" class="form-control" name="price" id="price"/>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-primary btn-block btn-lg" type="submit">Insert</button>
                </div>
              </form>
                  <div class="col-md-6">
                  <button class="btn btn-danger btn-block btn-lg" data-dismiss="modal">Cancel</button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

@endsection
