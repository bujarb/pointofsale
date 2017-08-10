<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use DB;
use Auth;
use App\Sale;
use App\User;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function getLoginPage(){
      return view('pages.login');
    }

    public function getHome(){
      $today = Carbon::now();
      $today = $today->toDateString('Y-m-d');
      /*$sales = Sale::where('user_id','=',Auth::user()->id)->where('created_at','=',$today)->get();
      $sales->transform(function($sale,$key){
        $sale->cart = unserialize($sale->cart);
        return $sale;
      });
      $data = [
        'total_price'=>0,
        'total_qty'=>0,
      ];
      foreach ($sales as $sale) {
        $data['total_price'] += $sale->total_price;
        foreach ($sale->cart as $cart) {
          $data['total_qty'] += (int)$cart->quantity;
        }
      }*/
      $count = 0;
      $users = User::all();
      $data = [];
      for($i=0;$i<count($users);$i++){
        $sales = Sale::where('user_id','=',$users[$i]['id'])->get();
        foreach ($sales as $sale) {
            $data[$count] = [
              'total'=>$sales->sum('total_price'),
            ];
        }
        $count++;
      }
      //dd($data);
      //dd($data);
      //dd($sales);
      return view('pages.home',['data'=>$data]);;
    }

    public function getSalesRegisterPage(){
      $mycart = Cart::all();
      $subtotal = 0;
      $tax = 1.80;
      $items = 0;
      foreach ($mycart as $cart) {
        $subtotal += $cart->quantity*$cart->product_price;
        $items += $cart->quantity;
      }
      $totalprice = $tax+$subtotal;
      $data = [
        'mycart'=>$mycart,
        'subtotal'=>$subtotal,
        'tax'=>$tax,
        'totalprice'=>$totalprice,
        'items'=>$items
      ];
      return view('pages.salesregister')->with($data);
    }
}
