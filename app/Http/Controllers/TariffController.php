<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index()
    {
        $counts = tariff::all();
        return view('tariff', compact('counts'));
   }

    public function store()
    {
       $data = request()->validate([
         'value' =>'',
       ]);
        tariff::create($data);
        return redirect()->route('tariff');
    }
}
