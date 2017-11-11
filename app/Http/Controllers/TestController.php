<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use Carbon\Carbon;

class TestController extends Controller
{
    public function testapi(){
      $today = Carbon::now();
      $today = $today->toDateString('Y-m-d');
      $sales = Sale::where('created_at','=',$today)->get();
      $total_price = 0;
      foreach ($sales as $sale) {
        $total_price += $sale->total_price;
      }
      return response()->json($total_price);
    }
}
