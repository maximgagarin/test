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
        return view('test');
    }

    public function test2()
    {

        $result = Counter::all();
      //  return $result;
        return view('test2', compact('result'));
    }

    public function test3()
    {

        $result = Counter::all();
          return $result;

    }


}


