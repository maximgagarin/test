<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\Prepay;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class DashboardController extends Controller
{
    public function index(Area $id)

    {
        $payments = Payment::withSum('payment_mov as sumpaid', 'sum')->where('areas_id', $id->id)->where('type', 'свет')->get();

        $payments2 = Payment::join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.areas_id', $id->id)
            ->where('payment_movs.sum', '>' ,0)
            ->select('payment_movs.payments_id', 'payment_movs.sum', 'payment_movs.date')
            ->get();

        $sumPaidSvet =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'свет')
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
             ->sum('payment_movs.sum');


        $totalPrepayPrihod = Prepay::where('saldo', 'приход')->sum('sum');
        $totalPrepayRashod = Prepay::where('saldo', 'расход')->sum('sum');
        $DifferencePrihodRashod = $totalPrepayPrihod - $totalPrepayRashod;

        $sumAllSvet = Payment::where('areas_id', $id->id)->where('type', 'свет')->where('status', 'неоплачен')->sum('sum');
        $sumLeft = $sumAllSvet - $sumPaidSvet;

        $lastValue = Counter::where('areas_id', $id->id)->latest('id')->value('value');


        return view('dashboard', compact('id',  'payments', 'payments2', 'sumAllSvet', 'sumPaidSvet', 'sumLeft', 'DifferencePrihodRashod', 'lastValue'));


    }


}
