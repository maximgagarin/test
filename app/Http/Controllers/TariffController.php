<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index()
    {
        $counts = tariff::where('type', 'энергия')->get();
        return view('tariff', compact('counts'));
    }

    public function store()
    {
        $data = request()->validate([
            'value' => ['numeric'],
            'type' => '',
        ]);
        $data['type'] = 'энергия';
        tariff::create($data);
        return redirect()->back();
    }


    public function vznos()
    {
        $counts = tariff::where('type', 'чвзнос')->get();
        $counts_road = tariff::where('type', 'дороги')->get();
        $counts_trash = tariff::where('type', 'мусор')->get();
        $counts_camera = tariff::where('type', 'благоустройство')->get();
        return view('vznos', compact('counts', 'counts_road','counts_trash', 'counts_camera' ));
    }

    public function calculationon()
    {

        $type = \request('type');
        $value = \request('value');

        $NumberAccrual = [
            'value' => $value,
            'type' => $type,
        ];
        tariff::create($NumberAccrual);

        $NumberAccrualID = tariff::latest('id')->value('id');
        $areas = Area::all();

        if ($type==='чвзнос'){
            $payments = $areas->map(function ($area) use ($value, $type, $NumberAccrualID) {
                $square = $area->square;
                $new = $square * $value;
                return [
                    'areas_id' => $area->id,
                    'type' => $type,
                    'unit' => 'руб',
                    'amount' => $square,
                    'tariff' => $value,
                    'sum' => $new,
                    'date' => now(),
                    'status' => 'неоплачен',
                    'NumberAccrualID' =>  $NumberAccrualID
                ];
            });

            Payment::insert($payments->toArray());
            return redirect()->back();
        }


        foreach ($areas as $area) {
            $square = $area->square;
            $new = $square * $value;
            $data = [
                'areas_id' => $area->id,
                'type' => $type,
                'unit' => 'руб',
                'amount' => $square,
                'tariff' => $value,
                'sum' => $value,
                'date' => now(),
                'status' => 'неоплачен',
                'NumberAccrualID' => $NumberAccrualID
            ];
            Payment::create($data);
        }
        return redirect()->back();
    }

    public function destroy()
    {
        $NumberAccrualID = \request('NumberAccrualID');
        Payment::where('NumberAccrualID', $NumberAccrualID)->delete();
        tariff::where('id', $NumberAccrualID)->delete();

        return redirect()->back();
    }

    public function edit()
    {
        $NewValue = \request('NewValue');
        $NumberAccrualID = \request('NumberAccrualID');

        $type = tariff::where('id', $NumberAccrualID)->value('type');

        $data=[
            'value' =>$NewValue,
            'type' =>$type,
        ];

        tariff::create($data);

        $lastId = tariff::latest('id')->value('id');




        $paymentsWithoutMovs = Payment::where('NumberAccrualID', $NumberAccrualID)->doesntHave('payment_mov')->get();

        $paymentsWithoutMovs->map(function ($payment) use ($NewValue, $lastId) {
            $square = $payment->amount;
            $payment->tariff = $NewValue;
            $payment->sum = $square * $NewValue;
            $payment->NumberAccrualID = $lastId;
            $payment->save();
        });




        return redirect()->back();
    }
}
