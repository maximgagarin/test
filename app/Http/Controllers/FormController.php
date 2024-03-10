<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use App\TestPay;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $data = \request();
        $id = $data['id'];
        $area =  Area::where('id', $id)->first();
        $name = $area->name;
        $number = $area->number;

        $svet = $data['svet'];
        $road = $data['road'];
        $camera = $data['camera'];
        $trash = $data['trash'];
        $chvznos = $data['chvznos'];
        $totalsum = $data['totalsum'];


        return view('form', compact('name','number', 'svet', 'trash', 'road', 'chvznos', 'totalsum', 'camera'));
    }




}


