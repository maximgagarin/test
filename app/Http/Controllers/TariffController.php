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
        $counts = tariff::where('type', 'свет')->get();
        return view('tariff', compact('counts'));
    }

    public function store()
    {
        $data = request()->validate([
            'value' => '',
            'type' => '',
        ]);
        $data['type'] = 'свет';
        tariff::create($data);
        return redirect()->back();
    }


    public function vznos()
    {
        $counts = tariff::where('type', 'чвзнос')->get();
        $counts_road = tariff::where('type', 'дороги')->get();
        $counts_trash = tariff::where('type', 'мусор')->get();
        $counts_camera = tariff::where('type', 'видеонаблюдение')->get();
        return view('vznos', compact('counts', 'counts_road','counts_trash', 'counts_camera' ));

    }

    public function calculationon()
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
        $data2 = [
            'value' => $value,
            'type' => $type,
        ];

        tariff::create($data2);
        return redirect()->back();
    }
}
