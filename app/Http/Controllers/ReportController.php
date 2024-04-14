<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   public function index()
   {
       $sum=0;
       return view('report', compact('sum'));
   }

   public function calc()
   {
        $sum =   Payment::query()->sum('sum');
        return view('report', compact('sum'));
   }
}
