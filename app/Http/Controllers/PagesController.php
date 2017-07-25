<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use DB;

class PagesController extends Controller
{
    public function getLoginPage(){
      return view('pages.login');
    }

    public function getHome(){
      return view('pages.home');
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
