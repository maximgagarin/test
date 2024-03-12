<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use App\TestPay;
use Illuminate\Http\Request;
use Kily\Payment\QR\Gost;
use Kily\Payment\QR\Exception as QRException;

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

    public function check()
    {
        $data = \request();

        $Name = $data['Name'];
        $personalAcc = $data['PersonalAcc'];
        $BankName = $data['BankName'];
        $BIC = $data['BIC'];
        $CorrespAcc = $data['CorrespAcc'];
        $Purpose = $data['Purpose'];
        $totalsum = $data['totalsum'];
        $Sum = $totalsum*100;



        $namesnt = $data['namesnt'];

        $g = new Gost();
        $g->Name = $Name;
         $g->PersonalAcc = $personalAcc;
        $g->BankName = $BankName;
         $g->BIC = "042007855";
        $g->CorrespAcc = $CorrespAcc;
        $g->Purpose = $Purpose;
        $g->Sum = $Sum;
        $g->validate();
        $g->render("qr.png");
        return view('check', compact('personalAcc', 'CorrespAcc','BankName', 'BIC', 'totalsum' , 'namesnt'));
    }




}


