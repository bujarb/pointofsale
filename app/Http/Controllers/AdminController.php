<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AdminController extends Controller
{
    public function getIndex(){
      return view('admin.index');
    }

    public function getAllUsers(){
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('admin.users.index',['users'=>$users]);
    }

}
