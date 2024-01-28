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


    public function vznos()
    {
        return view('vznos');
    }

    public function calculation()
    {

        $type = \request('type');
        $value = \request('value');

        $areas = Area::all();

        foreach ($areas as $area) {
            $square = $area->square;

            // Умножение значения на 10
            $new = $square * $value;

            // Создание новой записи в таблице payments
            $data = [
                'areas_id' => $area->id,
                'type' => $type,
                'unit' => 'руб',
                'amount' => $square,
                'tariff' => $value,
                'sum' => $new,
                'date' => now(),
                'status' => 'неоплачен',
            ];

            // Сохранение записи в базу данных
            Payment::create($data);
        }


    }
}
