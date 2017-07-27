<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Daily PDF</title>
    <link rel="stylesheet" href="css/reports/daily.css" />
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Total nr of items</th>
          <th>Payment Method</th>
          <th>Paid</th>
          <th>Costumer</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sale)
          <tr>
            <th>{{$sale->id}}</th>
            <th>{{count($sale->cart)}}</th>
            <th>{{$sale->payment_method}}</th>
            <th>{{$sale->paid ? 'Paid' : 'Not Paid'}}</th>
            <th>{{$sale->costumer}}</th>
            <th>{{$sale->total_price}}</th>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
