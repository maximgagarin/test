<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\payment_mov;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   public function index()
   {
       $sumPaid=0;
       $sumDebt=0;
       return view('report', compact('sumPaid','sumDebt'));
   }

   public function calc()
   {

        $Paid = payment_mov::query()->sum('sum');
        $sumPaid = number_format($Paid, 2, ',', ' ');

        $Debt =   Payment::query()->sum('sum');
       $sumDebt = number_format($Debt, 2, ',', ' ');

        return view('report', compact('sumPaid', 'sumDebt'));
   }
}
