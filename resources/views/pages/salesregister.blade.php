@extends('layouts.main')
@section('content')
  <div class="row fromtop">

  </div>
  <h4><i class="fa fa-barcode"></i> Sales Register</h4>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <form action="{{route('addToCart')}}" method="post">
          {{csrf_field()}}
            <input type="text" class="form-control barcode-reader" placeholder="Search product by sku or name,you can scan barcode too" name="search" id="search"/>
        </form>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Delete</th>
                <th>SKU</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Discount</th>
                <th>SubTotal</th>
              </tr>
            </thead>
            <tbody>
              @if (count($mycart)>0)
                @foreach ($mycart as $cart)
                  <tr id="fade">
                    <td>
                      <form action="{{route('delete-item',$cart->id)}}" method="post">
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-sm" id="fade">Remove</button>
                      </form>
                    </td>
                    <td>2212431</td>
                    <td>{{DB::table('products')->where('id','=',$cart->product_id)->pluck('name')->first()}}</td>
                    <td>{{$cart->product_price}}</td>
                    <td>
                      <form action="{{route('update-qty',$cart->product_id)}}" method="post">
                        {{csrf_field()}}
                        <input type="text" class="form-control input-sm product-input" value="{{$cart->quantity}}" name="qty" id="qty"/>
                      </form>
                    </td>
                    <td>
                      <form action="{{route('update-disc',$cart->product_id)}}" method="post">
                        {{csrf_field()}}
                        <input type="text" class="form-control input-sm product-input" value="0.00" name="disc" id="disc"/>
                      </form>
                    </td>
                    <td>{{($cart->quantity)*($cart->product_price)}}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
      </div>
    </div>
    <div class="col-md-4">
      <table class="table table-striped">
        <thead>
        </thead>
        <form action="{{route('sale-register')}}" method="post">
          {{csrf_field()}}
          <tbody>
            <tr>
              <br />
              <td class="col-md-12">
                <label class="lab"><i class="fa fa-user"></i> Costumer</label>
                <input type="text" class="form-control" placeholder="Select a costumer name"/>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-striped">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td class="col-sm-6">
                No. of Items in Cart
              </td>
              <td class="col-sm-6">
                {{count($mycart)}}
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                Subtotal:
              </td>
              <td class="col-sm-6">
                USD 0.00
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
                Tax:
              </td>
              <td class="col-sm-6">
                0.00
              </td>
            </tr>
            <tr>
              <td class="col-sm-6">
              </td>
              <td class="col-sm-6">
                <h1>USD {{$totalprice}}</h1>
              </td>
            </tr>
          </tbody>
      </table>
      <div class="row">
        <div class="col-sm-5 pull-right">
          <input type="submit" value="Payment" class="btn btn-default btn-block"/>
        </div>
      </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
  $( function() {
    $( "#search" ).autocomplete({
      source: 'http://localhost:8000/search'
    });
  });
  </script>
@if(Session::has('flashy_notification.message'))
<script id="flashy-template" type="text/template">
    <div class="flashy flashy--{{ Session::get('flashy_notification.type') }}">
        <i class="material-icons">speaker_notes</i>
        <a href="#" class="flashy__body" target="_blank"></a>
    </div>
</script>

<script>
    flashy("{{ Session::get('flashy_notification.message') }}", "{{ Session::get('flashy_notification.link') }}");
</script>
@endif
@endsection
