<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class PaymentmovsController extends Controller
{
    public function index()
    {

   }

    public function destroy($id)
    {
        // Получаем ID платежа перед удалением
        $paymentMov = payment_mov::find($id);

        if (!$paymentMov) {
            return redirect()->back()->with('error', 'Платеж не найден.');
        }

        $payment_id = $paymentMov->payments_id;

        // Проверяем, есть ли еще связанные записи
        $hasRelatedPayments = payment_mov::where('payments_id', $payment_id)->exists();

        // Удаляем запись из таблицы payment_mov
        $paymentMov->delete();

        if (!$hasRelatedPayments) {
            // Обновляем статус в таблице Payment на 'неоплачен'
            $payment = Payment::find($payment_id);

            if ($payment) {
                $payment->status = 'неоплачен';
                $payment->save();
            } else {
                return redirect()->back()->with('error', 'Платеж с указанным ID не найден.');
            }
        }


        $sumAllSvet = Payment::where('id', $payment_id)->sum('sum');
        $sumPay = payment_mov::where('payments_id', $payment_id)->sum('sum');
        $sumleft = $sumAllSvet - $sumPay;

        if ($hasRelatedPayments && $sumleft > 0) {
            $payment = Payment::find($payment_id);
            $payment->status = 'неоплачен';
            $payment->save();
            return redirect()->back()->with('success', 'Платеж успешно удален.');
        }

        return redirect()->back()->with('success', 'Платеж успешно удален.');
    }
}
