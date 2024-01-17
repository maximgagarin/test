<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        $counts= Counter::all();
return $counts;
       // return view('counter', compact('counts'));
   }

    public function store()
    {
        $value = request('value');
        $tariff = 3;
        $sum = $value*$tariff;

        $data = request()->validate([
            'value' => ['required', 'numeric', new Uppercase()],
            'date' => '',
            'areas_id' => 'required|numeric',
        ]);

        $value = $data['value'];
        $tariff = 3;
        $sum = $value*$tariff;

        Counter::create($data);
        $data2 = [
            'areas_id' => 1,
            'type' => 'свет',
            'unit' => 'квт',
            'amount' => 1,
            'tariff' => $tariff,
            'sum' => $sum,
            'date' => '',
            'status' => 'ok',

        ];
        Payment::create($data2);


        return redirect()->route('counter');
    }

    public function delete(Counter $id )
    {
       $id->delete();
        return redirect()->route('counter' );

    }
}
