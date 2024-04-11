<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use App\TestPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $PayeeINN = $data['PayeeINN'];

        $totalsum = $data['totalsum'];
        $Sum = $totalsum*100;



        $namesnt = $data['namesnt'];

        $g = new Gost();
        $g->Name = $Name;
         $g->PersonalAcc = $personalAcc;
        $g->BankName = $BankName;
         $g->BIC = $BIC;
        $g->CorrespAcc = $CorrespAcc;
        $g->Purpose = $Purpose;
        $g->Sum = $Sum;
        $g->PayeeINN=$PayeeINN;
        $g->validate();
        $g->render("qr.png");
        sleep(1);
        return view('check', compact('personalAcc', 'Name', 'CorrespAcc','BankName', 'BIC', 'totalsum' , 'namesnt', 'PayeeINN'));
    }




}


