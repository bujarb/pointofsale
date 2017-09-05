<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Product;
use Flashy;
use DB;
class ProductController extends Controller
{
    public function getProductsIndex(){
      $products = Product::paginate(10);
      return view('products.index',['products'=>$products]);
    }

    public function insertProduct(Request $request){
      $product = Product::where('sku','=',$request->sku)->first();
      if($product != null){
        $product->quantity = $product->quantity+$request->quantity;
        $product->update();

        Flashy::success('Your product was succesully updated');
        return redirect()->back();
      }else{
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
    }

    public function deleteProduct($product_id){
      $product = Product::find($product_id);
      $product->delete();

      return redirect()->back();
    }

    public function search(Request $request){
        if ($request->ajax()){
            $product = DB::table('products')->where('name','LIKE','%'.$request->search.'%')->get();
            $output = "";

            if ($product) {
                foreach ($product as $value) {
                    $output .= '<tr>';
                    $output .= '<td>' . $value->sku . '</td>';
                    $output .= '<td>' . $value->name . '</td>';
                    $output .= '<td>' . $value->quantity . '</td>';
                    $output .= '<td>' . $value->price . '</td>';
                    $output .= '<td>' . $value->unit . '</td>';
                    $output .= '<td>' . $value->suplier . '</td>';
                    $output .= '<td class="smaller"><a href="#" class="btn btn-info btn-sm btn-block">Edit</a></td>';
                    $output .= '<td class="smaller"><a href="#" class="btn btn-danger btn-sm btn-block">Delete</a></td>';
                    $output .= '</tr>';
                }

                return Response($output);
            }
        }
    }
}
