<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use Carbon\Carbon;
use DB;
use PDF;
use Flashy;

class ReportsController extends Controller
{

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


    /**
      * Methods for generating summary reports on sales
    */

    public function getSummaryReportsIndex(){
      return view('reports.summary');
    }

    public function generateSummaryReport(Request $request){
      //dd($request);
      $choice = $request->input('choice');

      $from = $request->input('datefrom');
      $to = $request->input('dateto');

      if($from&$to){
        $reports = Sale::whereBetween('created_at',[$from,$to])->get();
        $reports->transform(function($report,$key){
          $report->cart = unserialize($report->cart);
          return $report;
        });
        foreach ($reports as $report) {
          $rep = [
            'type'=>'Date',
            'date'=> $from.' - '.$to,
            'total_price'=> $reports->sum('total_price'),
            'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
            'payment_method'=> $report->payment_method,
            'quantity'=> (int)$report->cart->sum('quantity'),
          ];
        }
        return view('reports.summary',['rep'=>$rep]);
      }else{
        $today = Carbon::now();
        $today = $today->toDateString();
        $reports = Sale::where('created_at',$today)->get();
        if (count($reports)>0) {
          $reports->transform(function($report,$key){
            $report->cart = unserialize($report->cart);
            return $report;
          });
          foreach ($reports as $report) {
            $rep = [
              'type'=>'Today',
              'date'=> $today,
              'total_price'=> $reports->sum('total_price'),
              'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
              'payment_method'=> $report->payment_method,
              'quantity'=> (int)$report->cart->sum('quantity'),
            ];
          }

          return view('reports.summary',['rep'=>$rep]);

        }else{
          Flashy::error("No sales found today");
          return redirect()->back();
        }
      }
    }

    public function generateDetailedReport(Request $request){

    }
}
