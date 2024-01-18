<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
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
            'status' => 'ok',

        ];
        Payment::create($data2);


        return redirect()->route('counter');
    }

    public function pay($id)
    {

        $data = request()->validate([
            'value' => '',
        ]);

        $value= $data['value'];


        $TypePayment = 'свет';
        $payments = Payment::select(['id', 'sum'])
            ->where('areas_id', $id)
            ->where('type', 'свет')
            ->get();

        $allPaymentsPaid = true;

        foreach ($payments as $payment) {

            $paymentId = $payment['id'];

            $paymentSumm = $payment['sum'];
            $paidSum = Payment::withSum('payment_mov as sumpaid', 'sum')->where('type', 'свет')->where('id', $paymentId)->value('sumpaid');//сколько оплачено

            $remainingSumm = $paymentSumm - $paidSum; // Сколько осталось доплатить

            if ($remainingSumm > 0) {
                $allPaymentsPaid = false;
            }


            if ($remainingSumm <= 0) {
                Payment::where('id', $paymentId)->update(['status' => 'оплачен']);
                continue;
            }
            if ($value >= $remainingSumm) {


                // Если в переменной $value достаточно денег, чтобы оплатить оставшуюся сумму
                $value -= $remainingSumm; // Вычитаем сумму платежа из переменной $value
                payment_mov::create([
                    'payments_id' => $paymentId,
                    'sum' => $remainingSumm,
                    'date' => now(),
                ]);
                Payment::where('id', $paymentId)->update(['status' => 'оплачен']);
                continue;
            }
            else{

                payment_mov::create([
                    'payments_id' => $paymentId,
                    'sum' => $value,
                    'date' => now(), // Use Laravel's now() helper to get the current date and time

                ]);
                $value = 0;
            }


        }

    }

}
