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
        $totalsum = $data['totalsum'];
        $totalsumForg = $totalsum*100;
        $name = $data['name'];

        $g = new Gost();
        $g->Name = 'Мирошников Максим Викторович';
        $ParsonalAcc = $g->PersonalAcc = '40817810254986004300';
        $BankName = $g->BankName = 'Филиал № 3652 Банка ВТБ (публичное акционерное общество) в г. Воронеже';
        $BIC = $g->BIC = '042007855';
        $g->CorrespAcc = '30101810545250000855';
        $g->Purpose = 'ДолгСНТ';
        $g->Sum = $totalsumForg;
        $g->validate();
        $g->render("qr.png");
        return view('check', compact('ParsonalAcc', 'BankName', 'BIC', 'totalsum' , 'name'));
    }




}


