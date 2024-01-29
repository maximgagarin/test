<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {

        $areas = Area::select('id', 'number')
            ->with('getTotalPaymentsSum')
            ->get();

        return view('test');
    }

}
