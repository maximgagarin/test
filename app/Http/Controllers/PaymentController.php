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
            'amount' => ['numeric'],
            'tariff' => '',
            'sum' => ['numeric', 'required'],
            'type' => '',
            'date' => ['date', 'required'],
        ]);

        $data['areas_id'] = $id;


        $data['status'] = 'неоплачен';


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


        $TypePayment = 'энергия';
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
                $allPaymentsPaid = 0;

                payment_mov::where('sum', 0)->delete();
                continue;
            }
            else{
                payment_mov::create([
                    'payments_id' => $paymentId,
                    'sum' => $value,
                    'date' => now(), // Use Laravel's now() helper to get the current date and time
                ]);
                $value = 0;

                payment_mov::where('sum', 0)->delete();

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

    public function update()
    {

        $data = request()->validate([
            'amount' => '',
            'tariff' => '',
            'sum' => '',
            'type' => '',
            'id' => '',
        ]);

        $payment = Payment::find($data['id']);

        $payment->update([
            'amount' => $data['amount'],
            'tariff' => $data['tariff'],
            'sum' => $data['sum'],
            'type' => $data['type'],
            // Другие поля, которые вы хотите обновить
        ]);

        return redirect()->back()->with('success', 'Payment updated successfully');


    }
    public function  destroy($id)
    {
        payment_mov::where('sum', 0)->delete();

        $payment = Payment::find($id);


        if (Payment::where('id', $id)->has('payment_mov')->exists()) {

           $sum  =  Payment::where('id',$id)->withSum('payment_mov as summ', 'sum')->value('summ');

            $data =[
                'sum' => $sum,
                'areas_id' =>$payment->areas_id,
                'date' => now(),
                'saldo' => 'приход'
            ];
            payment_mov::where('payments_id',$id)->delete();
            Prepay::create($data);
            $payment->delete();
            return redirect()->back();
        } else {
            $payment->delete();
            return redirect()->back();
        }


        }

}
