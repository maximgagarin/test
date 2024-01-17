<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class DashboardController extends Controller
{
    public function index(Area $id)

    {
        $payments = Payment::withSum('payment_mov as sumpaid', 'sum')->where('areas_id', $id->id)->where('type', 'свет')->get();
        $paymentsChVznos = Payment::withSum('payment_mov as sumpaid', 'sum')->where('areas_id', $id->id)->where('type', 'чвзнос')->get();
        $payments = Payment::withSum('payment_mov as sumpaid', 'sum')->where('areas_id', $id->id)->where('type', 'свет')->get();
        //$counters = Counter::where('areas_id', $id->id)->get();



        $sumPaidSvet =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'свет')
             ->sum('payment_movs.sum');
        $sumAllSvet = Payment::where('areas_id', $id->id)->where('type', 'свет')->sum('sum');
        $sumLeft = $sumAllSvet - $sumPaidSvet;


        return view('dashboard', compact('id',  'payments', 'sumAllSvet', 'sumPaidSvet', 'sumLeft'));

        // $payments = Payment::all()->where('areas_id', $id->id)->where('type', 'свет');
    }


}
