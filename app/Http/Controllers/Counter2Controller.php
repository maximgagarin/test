<?php

namespace App\Http\Controllers;


use App\Models\Counter;
use App\Models\Incoming;
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
        $data = request()->validate([
            'value' => ['required', 'numeric', 'digits:5'],
            'date' => '',
            'areas_id' => '',
        ]);
        Counter::create($data);
        return redirect()->route('dashboard',['id' => $id]);
    }

    public function store3()

    {

        $tariff = request('select');
        $id = request('areas_id');
        $latestDate = Counter::where('areas_id', $id)->latest('date')->value('date');
        $lastValue = Counter::where('areas_id', $id)->latest('date')->value('value');
        $data = request()->validate([
            'value' => ['required', 'numeric', 'digits:5', new Uppercase($id)],
            'date' => "after:{$latestDate}",
            'select' => ['numeric'],
            'areas_id' => '',
        ]);
            $value = $data['value'];
            $date = $data['date'];
            $razn = $value - $lastValue;
            $sum = $razn * $tariff;

            $data3=[
                'value' => $value,
                'date' => $date,
                'areas_id' => $id,
            ];
            Counter::create($data3);

            sleep(1);

        $secondIdCounter =  Counter::latest('id')->value('id');
        $dateEnd =  Counter::latest('id')->value('date');

        $previosIdCounter = Counter::latest('id')->skip(1)->take(1)->value('id');
        $dateStart = Counter::latest('id')->skip(1)->take(1)->value('date');


        $data2 = [
            'areas_id' => $id,
            'type' => 'свет',
            'unit' => 'квт',
            'amount' => $razn,
            'tariff' => $tariff,
            'sum' => $sum,
            'date' => $date,
            'status' => 'неоплачен',
            'start' => $previosIdCounter,
            'end' => $secondIdCounter,
            'datestart' => $dateStart,
            'dateend' => $dateEnd,
        ];

           Payment::create($data2);

        return redirect()->route('dashboard',['id' => $id]);
    }


    public function delete($id)
    {
        $counter = Counter::find($id);

        if ($counter) {
            $counter->delete();
            return redirect()->route('dashboard', ['id' => $counter->areas_id])->with('success', 'Запись успешно удалена.');
        } else {
            return redirect()->route('dashboard', ['id' => $counter->areas_id])->with('success', 'Запись не найдена');
        }
    }

    public function update()
    {
        $data = request()->validate([
            'value' => ['required', 'numeric', 'digits:5'],
            'id'=>'',
        ]);

        $counter = Counter::find($data['id']);
        $counterId = $counter->id;
        $counterValueOld = $counter->value;

        $counter->update([
            'value' => $data['value'],
        ]);


        $payment = Payment::where('end', $counterId)->get();
        $sumPaymentOld = $payment->sum;


        return redirect()->route('dashboard', ['id' => $counter->areas_id])->with('success', 'Запись успешно удалена.');
    }
}
