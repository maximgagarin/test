<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use App\TestPay;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $sum = Area::withCount('paymentsmovs')->get();
        return view('test', compact('sum'));
    }

}

