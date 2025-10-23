<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth:admin');
   }

   public function dashboard()
   {
    return view('backend.admin.dashboard');
   }
}
