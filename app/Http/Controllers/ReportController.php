<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Incoming;
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

       $SummPaid=0;
       $SummDebt=0;

       $summPrepay = 0;


       return view('report', compact('sumPaid','sumDebt', 'DebtChvznos',
           'PaidChvznos', 'DebtSvet' ,'PaidSvet', 'DebtTrash' , 'PaidTrash' , 'DebtRoad' , 'PaidRoad' , 'DebtBlag' , 'PaidBlag', 'SummPaid', 'SummDebt', 'summPrepay'));
   }

   public function calc()
   {

       $date1 = \request('date1');
       $date2 = \request('date2');
       $date3 = date('Y-m-d', strtotime($date2 . ' +1 day'));

        $PaidAll = payment_mov::query()->sum('sum');
        $Paid = payment_mov::query()->whereBetween('date', [$date1, $date2])->sum('sum');


        $sumPaid = number_format($Paid, 2, ',', ' ');
        $Debt =   Payment::query()->sum('sum');

        $summPrepay = Incoming::sum('sum_left');



        //чвзнос
       $DebtChvznos = Area::LeftJoin('payments', 'areas.id', '=', 'payments.areas_id')->where('area_status', 1)->where('payments.type', 'чвзнос')->whereNull('payments.deleted_at')->sum('payments.sum');

       $PaidChvznos = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'чвзнос')->whereBetween('payment_movs.date', [$date1, $date2])->sum('payment_movs.sum');

       //свет
       $DebtSvet =   Payment::where('type', 'энергия')->whereNull('payments.deleted_at')->sum('sum');
       $PaidSvet = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'энергия')->whereNull('prepays')->whereBetween('payment_movs.date', [$date1, $date2])->sum('payment_movs.sum');

       //мусор
       $DebtTrash = Area::LeftJoin('payments', 'areas.id', '=', 'payments.areas_id')->where('area_status', 1)->where('payments.type', 'мусор')->whereNull('payments.deleted_at')->sum('payments.sum');

       $PaidTrash = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'мусор')->whereBetween('payment_movs.date', [$date1, $date2])->sum('payment_movs.sum');

       //дороги
       $DebtRoad = Area::LeftJoin('payments', 'areas.id', '=', 'payments.areas_id')->where('area_status', 1)->whereNull('payments.deleted_at')->where('payments.type', 'дороги')->sum('payments.sum');
       $PaidRoad = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'дороги')->whereBetween('payment_movs.date', [$date1, $date2])->sum('payment_movs.sum');

       //благоустройство
       $DebtBlag = Area::LeftJoin('payments', 'areas.id', '=', 'payments.areas_id')->where('area_status', 1)->whereNull('payments.deleted_at')->where('payments.type', 'благоустройство')->sum('payments.sum');
       $PaidBlag = Payment::leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')->where('type', 'благоустройство')->whereBetween('payment_movs.date', [$date1, $date2])->sum('payment_movs.sum');



        $SummPaid = $PaidChvznos + $PaidBlag +$PaidRoad +$PaidTrash +$PaidSvet + $summPrepay;
        $SummDebt =  $DebtChvznos + $DebtBlag + $DebtRoad + $DebtTrash + $DebtSvet;




       $Total = $Debt - $PaidAll;
       $sumDebt = number_format($Total, 2, ',', ' ');

        return view('report', compact('sumPaid', 'sumDebt', 'date1', 'date2', 'DebtChvznos',
            'PaidChvznos', 'DebtSvet' ,'PaidSvet', 'DebtTrash' , 'PaidTrash' , 'DebtRoad' , 'PaidRoad' , 'DebtBlag' , 'PaidBlag' ,'SummPaid', 'SummDebt', 'summPrepay'));
   }

   public function print()


   {
       $DebtSvet=\request('DebtSvet');
       $PaidSvet=\request('PaidSvet');

       $DebtTrash=\request('DebtTrash');
       $PaidTrash=\request('PaidTrash');

       $DebtRoad=\request('DebtRoad');
       $PaidRoad=\request('PaidRoad');

       $DebtChvznos = \request('DebtChvznos');

       $PaidChvznos=\request('PaidChvznos');

       $DebtBlag=\request('DebtBlag');
       $PaidBlag=\request('PaidBlag');

       $SummPaid=\request('SummPaid');
       $SummDebt=\request('SummDebt');

       $summPrepay=\request('summPrepay');

       $date1=\request('date1');
       $date2=\request('date2');




       return view('reportprint', compact( 'date1', 'date2', 'DebtChvznos',
           'PaidChvznos', 'DebtSvet' ,'PaidSvet', 'DebtTrash' , 'PaidTrash' , 'DebtRoad' , 'PaidRoad' , 'DebtBlag' , 'PaidBlag' ,'SummPaid', 'SummDebt', 'summPrepay'));
   }

}
