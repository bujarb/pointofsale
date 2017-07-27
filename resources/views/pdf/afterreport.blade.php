<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="css/reports/daily.css" media="all" />
    <!-- Latest compiled and minified CSS -->
  </head>
  <body>
    <header class="clearfix">
      <h1>Point of Sale Invoice</h1>
      <div id="project">
        <div><span>Company</span> Elektro Erisi</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
      </div>
      <div id="project1">
        <div><span>PROJECT</span> Website development</div>
        <div><span>CLIENT</span> John Doe</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
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
              </tr>
            @endforeach
          @endforeach
          <tr>
            <td class="my"></td>
            <td class="my"></td>
            <td class="my"></td>
            <td class="my">Total: {{$total}}</td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
