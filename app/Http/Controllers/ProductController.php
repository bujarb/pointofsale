<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function getProductsIndex(){
      $products = Product::paginate(10);
      return view('products.index',['products'=>$products]);
    }

    public function insertProduct(Request $request){
      $product = new Product();
      $product->name = $request->name;
      $product->sku = $request->sku;
      $product->price = $request->price;
      $product->quantity = $request->quantity;
      $product->unit = $request->unit;
      $product->suplier = $request->suplier;
      $product->save();

      return redirect()->route('product-index');
    }

    public function deleteProduct($product_id){
      $product = Product::find($product_id);
      $product->delete();

      return redirect()->back();
    }
}
