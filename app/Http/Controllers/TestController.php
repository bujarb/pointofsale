<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use Carbon\Carbon;

class TestController extends Controller
{
    public function testapi(){
      $today = Carbon::now();
      $today = $today->toDateString('Y-m-d');
      $reports = Sale::where('created_at','=',$today)->get();

      return response()->json(compact($reports));
    }
}
