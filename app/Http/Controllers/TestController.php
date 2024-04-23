<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use App\TestPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }

    public function test2()
    {

        $results =Area::select('areas.name')
            ->addSelect(DB::raw('SUM(payments.sum) as total_payments_sum'))
            ->addSelect(DB::raw('SUM(payment_movs.sum) as total_payment_movs_sum'))
            ->join('payments', 'areas.id', '=', 'payments.areas_id')
            ->join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->groupBy('areas.name')
            ->get();

        return view('test2', compact('results'));
    }

    public function test3()
    {


    }


}


