<?php

namespace App\Http\Controllers;


use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class Counter2Controller extends Controller
{
    public function index($id)
    {
        $lastValue = Counter::where('areas_id', $id)->latest('id')->value('value');
        $tariffs = tariff::query()->select('value')->get();
        $counts = Counter::where('areas_id', $id)->get();
        return view('counter2', compact('counts', 'id', 'tariffs', 'lastValue'));
   }

    public function store()
    {

        $id = request('areas_id');

        $latestDate = Counter::where('areas_id', $id)->latest('date')->value('date');
        $lastValue = Counter::where('areas_id', $id)->latest('date')->value('value');
        $data = request()->validate([
            'value' => ['required','numeric', 'digits:5', new Uppercase($id)],
            'date' => [
                'required',
                'date',
                'after:' . $latestDate,
            ],
            'areas_id' => '',
            'select' => ['required', 'numeric'],
        ]);


        $tariff = $data['select'];

        unset($data['select']);

        Counter::create($data);

        if (!empty($lastValue)) {
            $value = $data['value'];
            $date = $data['date'];
            $razn = $value - $lastValue;


            $sum = $razn * $tariff;


            $data2 = [
                'areas_id' => $id,
                'type' => 'свет',
                'unit' => 'квт',
                'amount' => $razn,
                'tariff' => $tariff,
                'sum' => $sum,
                'date' => $date,
                'status' => 'неоплачен',

            ];
            Payment::create($data2);
        }

        return redirect()->route('dashboard',['id' => $id]);
    }
}
