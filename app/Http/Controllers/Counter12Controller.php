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
        $tariffs = tariff::query()->select('value')->get();
        $counts = Counter::where('areas_id', $id)->get();
       // $counts2 = Counter::where('areas_id', $id)->get()->first();
        //$id = $counts2->areas_id;


        return view('counter2', compact('counts', 'id', 'tariffs'));
   }

    public function store()
    {

        $id = request('areas_id');
        $tariff = request('select');
        $lastValue = Counter::where('areas_id', $id)->latest('id')->value('value');
        $data = request()->validate([
            'value' => ['required','numeric', new Uppercase($id)],
            'date' => '',
            'areas_id' => '',
        ]);
        Counter::create($data);


        $value = $data['value'];
        $data2 = $data['date'];
        $razn = $value - $lastValue;


        $sum = $razn*$tariff;


        $data2 = [
            'areas_id' => $id,
            'type' => 'свет',
            'unit' => 'квт',
            'amount' => $razn,
            'tariff' => $tariff,
            'sum' => $sum,
            'date' => $data2,
            'status' => 'ok',

        ];
        Payment::create($data2);

        return redirect()->route('dashboard',['id' => $id]);
    }
}
