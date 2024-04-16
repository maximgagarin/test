<?php

namespace App\Http\Controllers;


use App\Models\Counter;
use App\Models\Incoming;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return redirect()->route('dashboard',['id' => $id])->with('success', 'Показания добавлены');
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

       // $secondIdCounter =  Counter::where('areas_id', $id)->latest('date')->value('id');
      //  $dateEnd =  Counter::latest('id')->value('date');

       // $previosIdCounter = Counter::latest('id')->skip(1)->take(1)->value('id');
      //  $dateStart = Counter::latest('id')->skip(1)->take(1)->value('date');


        $data2 = [
            'areas_id' => $id,
            'type' => 'энергия',
            'unit' => 'квт',
            'amount' => $razn,
            'tariff' => $tariff,
            'sum' => $sum,
            'date' => $date,
            'status' => 'неоплачен',
            'start' => 0,
            'end' => 0,
            'datestart' => $latestDate,
            'dateend' => $date,
        ];

           Payment::create($data2);

        return redirect()->route('dashboard',['id' => $id]);

        // Валидация данных
//        $data = request()->validate([
//            'value' => ['required', 'numeric', 'digits:5', new Uppercase(request('areas_id'))],
//            'date' => "after:".Counter::where('areas_id', request('areas_id'))->latest('date')->value('date'),
//            'select' => ['numeric'],
//            'areas_id' => '',
//        ]);
//
//        $id = $data['areas_id'];
//        $value = $data['value'];
//        $tariff = request('select');
//        $latestDate = Counter::where('areas_id', $id)->latest('date')->value('date');
//        $lastValue = Counter::where('areas_id', $id)->latest('date')->value('value');
//        $razn = $value - $lastValue;
//        $sum = $razn * $tariff;
//
//        // Используем транзакцию для обеспечения целостности данных
//        DB::transaction(function () use ($data, $id, $value, $tariff, $razn, $sum) {
//            // Создание записи в таблице Counter
//            $counterData = [
//                'value' => $value,
//                'date' => $data['date'],
//                'areas_id' => $id,
//            ];
//            Counter::create($counterData);
//
//            // Ожидание 1 секунды (почему?)
//            sleep(1);
//
//            // Получение данных о предыдущем и текущем счетчиках
//            $latestCounter = Counter::latest('id')->first();
//            $prevCounter = Counter::find($latestCounter->id - 1);
//
//            // Создание записи в таблице Payment
//            $paymentData = [
//                'areas_id' => $id,
//                'type' => 'энергия',
//                'unit' => 'квт',
//                'amount' => $razn,
//                'tariff' => $tariff,
//                'sum' => $sum,
//                'date' => $data['date'],
//                'status' => 'неоплачен',
//                'start' => $prevCounter->id,
//                'end' => $latestCounter->id,
//                'datestart' => $prevCounter->date,
//                'dateend' => $latestCounter->date,
//            ];
//            Payment::create($paymentData);
//        });
//
//        return redirect()->route('dashboard', ['id' => $id]);


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
