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
      $totalprice = 0;
      foreach ($mycart as $cart) {
        $totalprice += $cart->quantity*$cart->product_price;
      }
      return view('pages.salesregister',['mycart'=>$mycart,'totalprice'=>$totalprice]);
    }
}
