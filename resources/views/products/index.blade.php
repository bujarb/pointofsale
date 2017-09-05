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
          <input type="text" class="form-control" id="search" name="search"/>
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
            <th>SKU</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Unit</th>
            <th>Suplier</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $key => $product)
            <tr>
              <td>{{$product->sku}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->quantity}}</td>
              <td>{{$product->price}}</td>
              <td>{{$product->unit}}</td>
              <td>{{$product->suplier}}</td>
              <td class="smaller"><a href="#" class="btn btn-info btn-sm btn-block">Edit</a></td>
              <td class="smaller">
                <form action="{{route('product-delete',$product->id)}}" method="post">
                    {{csrf_field()}}
                    <button class="btn btn-danger btn-sm btn-block confirm" onclick="return $(".confirm").confirm()">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
{{$products->links()}}

<!-- Modal -->
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
              <div class="form-group">
                <label>Unit:</label>
                <select name="unit" id="unit" class="form-control">
                  <option value="meter">Meter</option>
                  <option value="sasi">Piece</option>
                </select>
              </div>
              <div class="form-group">
                <label>Suplier:</label>
                <input type="text" class="form-control" name="suplier" id="suplier"/>
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
<!-- End of Modal -->
@endsection
@section('script')
  <script type="text/javascript">
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });

    $('#search').on('keyup',function () {
        $value=$(this).val();
        $.ajax({
          type:'get',
          url:'{{URL::to('psearch')}}',
          data: {'search':$value},
          success:function (data) {
              $('tbody  ').html(data);
          }
        });
    })
  </script>
@endsection
