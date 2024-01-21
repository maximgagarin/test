<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\Prepay;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments= Payment::all();
        return view('payments', compact('payments'));
   }

    public function store($id)
    {

        $data = request()->validate([
           // 'areas_id' => '',
            'amount' => '',
            'tariff' => '',
            'sum' => '',
            'type' => '',
        ]);

        $data['areas_id'] = $id;
       // $data['type'] = 'свет';
        $data['unit'] = 'квт';
        $data['status'] = 'неоплачен';
        $data['date'] = '2012-12-12';

        Payment::create($data);

        return redirect()->route('dashboard', compact('id'));
    }

    public function pay($id)
    {
        $type = \request('type');

        $data = request()->validate([
            'value' => '',
        ]);

        $value= $data['value'];


        $TypePayment = 'свет';
        $payments = Payment::select(['id', 'sum'])
            ->where('areas_id', $id)
            ->where('type', $type)
            ->get();

        $allPaymentsPaid = 1;

        foreach ($payments as $payment) {
            $paymentId = $payment['id'];
            $paymentSumm = $payment['sum'];
            $paidSum = Payment::withSum('payment_mov as sumpaid', 'sum')->where('type', $type)->where('id', $paymentId)->value('sumpaid');//сколько оплачено


            $remainingSumm = $paymentSumm - $paidSum; // Сколько осталось доплатить

            if ($remainingSumm == 0) {
                $allPaymentsPaid = 0;
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
        if ($allPaymentsPaid ==0 && $value > 0) {
            echo 'Remaining Value: ' . $value;
            $data =[
                'sum' => $value,
                'areas_id' =>$id,
                'date' => now(),
                'saldo' => 'приход'
            ];
            Prepay::create($data);


        }
        return redirect()->route('dashboard', compact('id'));
    }
}
