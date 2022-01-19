<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class Dashboard_Controller extends Controller
{
  
  public function AdminDashboard()
  {
    return view('admin.dashboard');
    // return redirect()->route('homepage');
  }



}
