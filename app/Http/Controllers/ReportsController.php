<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use Carbon\Carbon;
use DB;
use PDF;

class ReportsController extends Controller
{

    public function getReportsIndex(){
      return view('reports.index');
    }

    public function getDailyReport(){
      $dt = Carbon::now();
      $today = $dt->toDateString();
      $sales = DB::table('sales')->select('*')->where('created_at','=',$today)->get();
      $sales->transform(function($sale,$key){
        $sale->cart = unserialize($sale->cart);
        return $sale;
      });
      //dd($sales);
      return view('reports.daily',['sales'=>$sales]);
    }

    public function getInvoiceForSale($sale_id){
      $sales = Sale::where('id','=',$sale_id)->get();
      $sales->transform(function($sale,$key){
        $sale->cart = unserialize($sale->cart);
        return $sale;
      });
      $total = Sale::where('id','=',$sale_id)->pluck('total_price')->first();
      $pdf = PDF::loadView('pdf.afterreport',['sales'=>$sales,'total'=>$total])->setPaper('a4', 'landscape');
      return $pdf->download('sale.pdf');
    }

    public function generateReport(Request $request){
      //dd($request);
      $choice = $request->input('choice');

      switch ($choice) {
        case 'today':
          $today = Carbon::now();
          $today = $today->toDateString('Y-m-d');
          $reports = Sale::where('created_at','=',$today)->get();
          //dd($reports);
          return view('reports.index',['reports'=>$reports]);
          break;
        case 'yesterday':
          $yesterday = Carbon::yesterday();
          $yesterday = $yesterday->toDateString();
          $reports = Sale::where('created_at','=',$yesterday)->get();
          // /dd($reports);
          return view('reports.index',['reports'=>$reports]);
          break;
        case 'thisweek':
          $today = Carbon::today();
          $day = $today->day;
          var_dump($day);
      }
    }
}
