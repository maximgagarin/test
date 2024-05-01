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
        $g->PersonalAccount = '1234567890';
        $g->validate();
        $g->render("qr.png");
        sleep(1);
        return view('check', compact('personalAcc', 'Name', 'CorrespAcc','BankName', 'BIC', 'totalsum' , 'namesnt', 'PayeeINN'));
    }


    public function submit(Request $request)
    {


        $namesnt = $request->namesnt;
        $numbersnt = $request->numbersnt;
        $Firstname = $request->FirstName;
        $LastName = $request->LastName;

        $MiddleName = $request->MiddleName;




        // Получаем выбранные идентификаторы платежей из формы
        $selectedIds = $request->input('selected_payments');

        // Находим платежи с соответствующими идентификаторами
        $selectedPayments = Payment::whereIn('id', $selectedIds)->get();

        // Подсчитываем сумму поля 'sum' в выбранных платежах
        $totalsum = $selectedPayments->sum('sum');

        $sum = $totalsum*100;

        $Name = 'СНТ Заря-2';
        $personalAcc = '40703810835164901873';
        $BankName = 'Липецкое отделение №8593 ПАО Сбербанк г.Липецк';
        $BIC= '044206604';
        $CorrespAcc = '30101810800000000604';

        $PayeeINN='481300308';



        $g = new Gost();
        $g->Name = 'СНТ Заря-2';
        $g->PersonalAcc = '40703810835164901873';
        $g->BankName = 'Липецкое отделение №8593 ПАО Сбербанк г.Липецк';
        $g->BIC = '044206604';
        $g->CorrespAcc = '30101810800000000604';

        $g->Sum = $sum;
        $g->PayeeINN='4813003083';

        $g->LastName = $LastName;
        $g->FirstName =$Firstname;
        $g->MiddleName =$MiddleName;
        $g->PersAcc= $numbersnt; //номер участка
        $g->Purpose=$numbersnt; //назначение платежа

        $g->validate();
        $g->render("qr.png");
        sleep(1);
        return view('check', compact('personalAcc', 'Name', 'CorrespAcc','BankName', 'BIC', 'totalsum' , 'namesnt','numbersnt', 'PayeeINN', 'selectedPayments'));


    }




}


