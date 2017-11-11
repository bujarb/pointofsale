<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use App\Cart;
use App\Sale;
use Carbon\Carbon;
use Flashy;
use PDF;
use Auth;
use Illuminate\Support\Facades\Input;

class SalesController extends Controller
{
    public function search(Request $request){
      $term = $request->term;
      $product = Product::where('name','LIKE','%'.$term.'%')->get();
      //return $product;
      if(count($product) == 0){
        $searchResult[] = 'No product found';
      }else{
        foreach ($product as $value) {
          $searchResult[] = $value->name;
        }
      }

      return $searchResult;
    }
    public function addToCart(Request $request){
      $search = $request->input('search');
      //dd($request);
      if(!empty($search)){
        $product = Product::where('name','LIKE','%'.$search.'%')->orWhere('sku','=',$search)->first();
        if($product){
          $currentCart = Cart::where('product_id','=',$product->id)->first();
        }

        //dd($product);
        //dd($currentCart);

        if($product != null){
          if($product->quantity != 0){
            if($currentCart != null){
              $currentCart->quantity++;
              $currentCart->total_price = $currentCart->quantity * $product->price;
              $currentCart->update();
              Flashy::success('Product succesfully added to the cart');
              return redirect()->back();
            }else{
              $cart = new Cart();
              $cart->product_id = $product->id;
              $cart->product_price = $product->price;
              $cart->quantity = 1;
              $cart->total_price = $cart->quantity * $product->price;
              $cart->save();
              Flashy::success('Product succesfully added to the cart');
              return redirect()->back();
            }
          }else{
            Flashy::error('You do not have this item in stock anymore');
            return redirect()->back();
          }
        }else{
          return redirect()->back();
        }
      }else{
        return redirect()->back();
      }
    }

    public function updateQty(Request $request,$product_id){
      $qty = $request->input('qty');

      $cart = Cart::where('product_id','=',$product_id)->first();
      $product = Product::where('id','=',$product_id)->first();

      if($qty == 0){
        $cart->delete();
        return redirect()->back();
      }else if($product->quantity < $qty){
        Flashy::error('Sorry. You do not have that quantity in your database!');
        return redirect()->back();
      }else{
        $cart->quantity = $qty;
        $cart->total_price = $cart->quantity * $cart->product_price;
        $cart->update();
        Flashy::success('Quantity updated!');
        return redirect()->back();
      }
    }

    public function updateDiscount(Request $request,$product_id){
      $disc = $request->input('disc');

      $cart = Cart::where('product_id','=',$product_id)->first();

      if($disc < 0){
        return redirect()->back();
      }else{
        $cart->discount = $disc;
        $totaldisc = $cart->quantity*$disc;
        $cart->product_price = $cart->product_price - $disc;
        $cart->total_price = $cart->quantity * $cart->product_price;
        $cart->update();
        return redirect()->back();
      }
    }

    public function deleteItemFromCart($item_id){
      $item = Cart::where('id','=',$item_id)->first();

      $item->delete();
      Flashy::error('Product was succesfully deleted from the cart!');
      return redirect()->back();
    }

    public function registerSale(Request $request){
      // Get the current cart
      $cart = Cart::all();
      // Get the hour when this sale was registered
      $dt = Carbon::now();
      $time = $dt->hour.':'.$dt->minute.':'.$dt->second;

      // Create a new sale
      $sale = new Sale();
      $sale->cart = serialize($cart);
      $sale->payment_method = $request->type;
      $sale->time = $time;
      switch ($request->owe) {
        case 'on':
          $sale->paid = false;
          break;
        default:
          $sale->paid = true;
          break;
      }
      $sale->costumer = $request->costumer;
      foreach ($cart as $c) {
        $product = Product::find($c->product_id);
        $product->quantity = $product->quantity - $c->quantity;
        $product->save();
        $sale->total_price += $c->total_price;
        $c->delete();
      }
      $data = $request->cash - $sale->total_price;
      $user = Auth::user();
      $sale->cashier_id = $user->id;
      $sale->save();
      Flashy::success('Sale succesfully completed!');
      $sale->time = $time;
      return redirect()->route('sale-view',$sale->id);
    }

    public function deleteSale($id){
      $sale = Sale::find($id);
      $sale->delete();

      return redirect()->back();
    }

    public function getSalesPage(){
      $type = Input::get('type');

      switch ($type) {
        case 'paid':
            $sales = Sale::where('paid',1)->orderBy('time','desc')->paginate(10);
            $sales->transform(function($order,$key){
              $order->cart = unserialize($order->cart);
              return $order;
            });
            return view('sales.index',['sales'=>$sales]);
          break;
        case 'notpaid':
            $sales = Sale::where('paid',0)->orderBy('time','desc')->paginate(10);
            $sales->transform(function($order,$key){
              $order->cart = unserialize($order->cart);
              return $order;
            });
            return view('sales.index',['sales'=>$sales]);
          break;
        default:
            $sales = Sale::orderBy('time','desc')->paginate(10);
            $sales->transform(function($order,$key){
              $order->cart = unserialize($order->cart);
              return $order;
            });
            return view('sales.index',['sales'=>$sales]);
          break;
      }
    }

    public function getSoldPage(){
      return view('sales.sold');
    }

    public function getSingle($sale_id){
      $sale = Sale::find($sale_id);
      $sale = unserialize($sale->cart);
      return view('sales.single',['sale'=>$sale]);
    }

    public function getSaleView($sale_id){
      $sale = DB::table('sales')->select('*')->where('id','=',$sale_id)->get();
      $id = $sale_id;
      $sale->transform(function($sale,$key){
        $sale->cart = unserialize($sale->cart);
        return $sale;
      });
      $total_price = Sale::where('id','=',$sale_id)->pluck('total_price')->first();
      return view('sales.view',['sale'=>$sale,'id'=>$sale_id,'total'=>$total_price]);
    }
}
