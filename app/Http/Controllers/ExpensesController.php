<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\User;
class ExpensesController extends Controller
{
    public function getExpensesPage(){
      $expenses = Expense::all();
      return view('expenses.index',['expenses'=>$expenses]);
    }

    public function store(Request $request){
      $this->validate($request,[
        'label'=>'required',
        'amount'=>'required',
        'tax'=>'required',
        'reason'=>'max:2000',
        'who'=>'max:100'
      ]);

      $expense = new Expense();
      $expense->label = $request->input('label');
      $expense->amount = $request->input('amount');
      $expense->tax = $request->input('tax');
      $expense->reason = $request->input('reason');
      $expense->who = $request->input('who');
      $expense->save();

      return redirect()->back();
    }
}
