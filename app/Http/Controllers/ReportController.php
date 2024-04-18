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

       $DebtSvet=0;
       $PaidSvet=0;

       $DebtTrash=0;
       $PaidTrash=0;

       $DebtRoad=0;
       $PaidRoad=0;

       $DebtChvznos=0;
       $PaidChvznos=0;

       $DebtBlag=0;
       $PaidBlag=0;


       return view('report', compact('sumPaid','sumDebt', 'DebtChvznos',
           'PaidChvznos', 'DebtSvet' ,'PaidSvet', 'DebtTrash' , 'PaidTrash' , 'DebtRoad' , 'PaidRoad' , 'DebtBlag' , 'PaidBlag'));
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




        //чвзнос
       $DebtChvznos =   Payment::where('type', 'чвзнос')->where('status', 'неоплачен')->sum('sum');
       $PaidChvznos = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'чвзнос')->sum('payment_movs.sum');

       //свет
       $DebtSvet =   Payment::where('type', 'свет')->where('status', 'неоплачен')->sum('sum');
       $PaidSvet = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'свет')->sum('payment_movs.sum');

       //мусор
       $DebtTrash =   Payment::where('type', 'мусор')->where('status', 'неоплачен')->sum('sum');
       $PaidTrash = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'мусор')->sum('payment_movs.sum');

       //дороги
       $DebtRoad =   Payment::where('type', 'дороги')->where('status', 'неоплачен')->sum('sum');
       $PaidRoad = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'дороги')->sum('payment_movs.sum');

       //благоустройство
       $DebtBlag =   Payment::where('type', 'благоустройство')->where('status', 'неоплачен')->sum('sum');
       $PaidBlag = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'благоустройство')->sum('payment_movs.sum');








       $Total = $Debt - $PaidAll;
       $sumDebt = number_format($Total, 2, ',', ' ');

        return view('report', compact('sumPaid', 'sumDebt', 'date1', 'date2', 'DebtChvznos',
            'PaidChvznos', 'DebtSvet' ,'PaidSvet', 'DebtTrash' , 'PaidTrash' , 'DebtRoad' , 'PaidRoad' , 'DebtBlag' , 'PaidBlag'));
   }
}
