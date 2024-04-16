<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\payment_mov;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   public function index()
   {
       $Debt =   Payment::query()->sum('sum');
       $PaidAll = payment_mov::query()->sum('sum');

       $Total = $Debt - $PaidAll;

       $sumDebt = number_format($Total, 2, ',', ' ');
       $sumPaid=0;


       return view('report', compact('sumPaid','sumDebt'));
   }

   public function calc()
   {

       $date1 = \request('date1');
       $date2 = \request('date2');
       $date3 = date('Y-m-d', strtotime($date2 . ' +1 day'));

        $PaidAll = payment_mov::query()->sum('sum');


        $Paid = payment_mov::query()->whereBetween('date', [$date1, $date3])->sum('sum');

        $sumPaid = number_format($Paid, 2, ',', ' ');

        $Debt =   Payment::query()->sum('sum');


       $Total = $Debt - $PaidAll;
       $sumDebt = number_format($Total, 2, ',', ' ');

        return view('report', compact('sumPaid', 'sumDebt', 'date1', 'date2'));
   }
}
