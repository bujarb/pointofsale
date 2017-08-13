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

      switch ($choice) {
        case 'today':
          $today = Carbon::now();
          $today = $today->toDateString('Y-m-d');
          $reports = Sale::where('created_at','=',$today)->get();
          if(count($reports)>0){
            $rep = [];
            foreach ($reports as $report) {
              $rep = [
                'type'=>'Today',
                'date'=>$report->created_at->format('Y-m-d'),
                'total_price'=>$reports->sum('total_price'),
                'paid'=>$report->paid == 1 ? 'Paid' : 'Not Paid',
                'payment_method'=>$report->payment_method,
              ];
            }
            //dd($reports);
            return view('reports.summary',['rep'=>$rep]);
          }else{
            Flashy::info('No sales found today');
            return redirect()->back();
          }
          break;
        case 'yesterday':
          $yesterday = Carbon::yesterday();
          $yesterday = $yesterday->toDateString();
          $reports = Sale::where('created_at','=',$yesterday)->get();
          if(count($reports)>0){
            $rep = [];
            foreach ($reports as $report) {
              $rep = [
                'type'=>'Yesterday',
                'date'=>$report->created_at->format('Y-m-d'),
                'total_price'=>$reports->sum('total_price'),
                'paid'=>$report->paid == 1 ? 'Paid' : 'Not Paid',
                'payment_method'=>$report->payment_method,
              ];
            }
            return view('reports.summary',['rep'=>$rep]);
          }else{
            Flashy::info('No sales found yesterday!');
            return redirect()->back();
          }
          break;
        case 'thisweek':
          $date = Carbon::today();
          $week = $date->weekOfMonth;
          $dayOfWeek = $date->dayOfWeek;
          $date = $date->toDateString('Y-m-d');
          //var_dump($date);

          $firstDayOfWeek = Carbon::now();
          $firstDayOfWeek->day = 7-$dayOfWeek;
          $firstDayOfWeek = $firstDayOfWeek->toDateString('Y-m-d');
          //var_dump($firstDayOfWeek);

          $reports = Sale::whereBetween('created_at',[$firstDayOfWeek,$date])->get();
          $reports->transform(function($report,$key){
            $report->cart = unserialize($report->cart);
            return $report;
          });

          //dd($reports);

          if(count($reports)>0){
            foreach ($reports as $report) {
              $rep = [
                'type'=>'Week',
                'date'=> $firstDayOfWeek.' - Today',
                'total_price'=> $reports->sum('total_price'),
                'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
                'payment_method'=> $report->payment_method,
                'quantity'=> (int)$report->cart->sum('quantity'),
              ];
            }
            return view('reports.summary',['rep'=>$rep]);
          }else{
            Flashy::info('No sales found this week!');
            return redirect()->back();
          }
          break;
        case 'thismonth':
          $today = Carbon::today();
          $today = $today->toDateString('Y-m-d');

          $date = Carbon::today();
          $date->day = 1;
          $date = $date->toDateString('Y-m-d');

          $reports = Sale::whereBetween('created_at',[$date,$today])->get();
          $reports->transform(function($report,$key){
            $report->cart = unserialize($report->cart);
            return $report;
          });

          //dd($reports);

          if(count($reports)>0){
            foreach ($reports as $report) {
              $rep = [
                'type'=>'Week',
                'date'=> 'This Month',
                'total_price'=> $reports->sum('total_price'),
                'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
                'payment_method'=> $report->payment_method,
                'quantity'=> (int)$report->cart->sum('quantity'),
              ];
            }
            return view('reports.summary',['rep'=>$rep]);
          }else{
            Flashy::info('No sales found this month!');
            return redirect()->back();
          }
          break;
        case 'thisquarter':
          
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
            'type'=>'Date',
            'date'=> $from.' - '.$to,
            'total_price'=> $reports->sum('total_price'),
            'paid'=> $report->paid == 1 ? 'Paid' : 'Not Paid',
            'payment_method'=> $report->payment_method,
            'quantity'=> (int)$report->cart->sum('quantity'),
          ];
        }
        return view('reports.summary',['rep'=>$rep]);
      }
    }

    public function generateDetailedReport(Request $request){

    }
}
