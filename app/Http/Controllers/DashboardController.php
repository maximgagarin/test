<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\Prepay;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class DashboardController extends Controller
{
    public function index(Area $id)

    {
        $payments = Payment::withSum('payment_mov as sumpaid', 'sum')->where('areas_id', $id->id)->where('type', 'свет')->get();


        $totalPrepayPrihod = Prepay::where('saldo', 'приход')->where('areas_id', $id->id)->sum('sum');
        $totalPrepayRashod = Prepay::where('saldo', 'расход')->where('areas_id', $id->id)->sum('sum');
        $D = $totalPrepayPrihod - $totalPrepayRashod;


        $comment = Area::where('id', $id->id)->value('comment');


        $lastValue = Counter::where('areas_id', $id->id)->latest('id')->value('value'); //послед показ счетчика
        $lastValuedate = Counter::where('areas_id', $id->id)->latest('id')->value('date'); //послед показ счетчика

        $tariffs = tariff::query()->select('value')->where('type', 'свет')->get();


        return view('dashboard', compact('id' , 'comment', 'payments',  'tariffs' , 'D', 'lastValue', 'lastValuedate'));
    }
}
