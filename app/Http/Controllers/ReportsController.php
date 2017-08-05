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
          $rep = [];
          foreach ($reports as $report) {
            $rep = [
              'date'=>$report->created_at->format('Y-m-d'),
              'total_price'=>$reports->sum('total_price'),
              'paid'=>$report->paid == 1 ? 'Paid' : 'Not Paid',
              'payment_method'=>$report->payment_method,
            ];
          }
          return view('reports.index',['rep'=>$rep]);
          break;
        case 'thisweek':
          $date = Carbon::today();
          $week = $date->weekOfMonth;
          $dayOfWeek = $date->dayOfWeek;

          $firstDayOfWeek = Carbon::now();
          $firstDayOfWeek->day = 7-$dayOfWeek;
          $firstDayOfWeek = $firstDayOfWeek->format('D M d');

          $reports = Sale::whereBetween('created_at',[$firstDayOfWeek,$date])->get();
          $reports->transform(function($report,$key){
            $report->cart = unserialize($report->cart);
            return $report;
          });

          foreach ($reports as $report) {
            $rep = [
              'date'=> $firstDayOfWeek.' - Today',
              'total_price'=> $reports->sum('total_price'),
              'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
              'payment_method'=> $report->payment_method,
              'quantity'=> (int)$report->cart->sum('quantity'),
            ];
          }
          return view('reports.index',['rep'=>$rep]);
          break;
      }

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
            'date'=> $from.' - '.$to,
            'total_price'=> $reports->sum('total_price'),
            'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
            'payment_method'=> $report->payment_method,
            'quantity'=> (int)$report->cart->sum('quantity'),
          ];
        }
        return view('reports.index',['rep'=>$rep]);
      }
    }
}
