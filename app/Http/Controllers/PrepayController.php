<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\Prepay;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class PrepayController extends Controller
{
    public function prepay($id)
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

        $allPaymentsPaid = 1;

        foreach ($payments as $payment) {
            $paymentId = $payment['id'];
            $paymentSumm = $payment['sum'];
            $paidSum = Payment::withSum('payment_mov as sumpaid', 'sum')->where('type', 'свет')->where('id', $paymentId)->value('sumpaid');//сколько оплачено


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
                Prepay::create([
                        'sum' => $remainingSumm,
                        'areas_id' =>$id,
                        'date' => now(),
                        'saldo' => 'расход'
                    ]
                );
                Payment::where('id', $paymentId)->update(['status' => 'оплачен']);
                continue;
            }
            else{
                payment_mov::create([
                    'payments_id' => $paymentId,
                    'sum' => $value,
                    'date' => now(), // Use Laravel's now() helper to get the current date and time
                ]);
                Prepay::create([
                        'sum' => $value,
                        'areas_id' =>$id,
                        'date' => now(),
                        'saldo' => 'расход'
                    ]
                );
                $value = 0;
            }
        }
        if ($allPaymentsPaid ==0 && $value > 0) {
            echo 'Remaining Value: ' . $value;
            $data =[
                'sum' => $value,
                'areas_id' =>$id,
                'date' => now(),
                'saldo' => 'остаток'
            ];
            Prepay::create($data);


        }
        return redirect()->route('dashboard', compact('id'));


    }


}
