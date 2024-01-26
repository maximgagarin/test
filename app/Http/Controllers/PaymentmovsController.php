<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\Prepay;
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
        // Находим запись в таблице payment_mov
        $paymentMov = payment_mov::find($id);
        $areas_id = \request('areas_id');


        if($paymentMov->prepays){

            // Получаем ID платежа перед удалением
            $payment_id = $paymentMov->payments_id;


            // Удаляем запись из таблицы payment_mov
            $paymentMov->delete();   $data = [
                'sum' => $paymentMov->sum,
                'areas_id' => $areas_id,
                'date' => now(),
                'saldo' => 'приход',
            ];
            Prepay::create($data);


            // Проверяем, есть ли еще связанные записи
            $hasRelatedPayments = payment_mov::where('payments_id', $payment_id)->exists();

            if (!$hasRelatedPayments) {
                // Обновляем статус в таблице Payment на 'неоплачен'
                Payment::where('id', $payment_id)->update(['status' => 'неоплачен']);
            }

            // Подсчитываем сумму с использованием агрегатной функции
            $sumAllSvet = Payment::where('id', $payment_id)->sum('sum');
            $sumPay = payment_mov::where('payments_id', $payment_id)->sum('sum');
            $sumleft = $sumAllSvet - $sumPay;

            if ($hasRelatedPayments && $sumleft > 0) {
                // Если есть связанные платежи и сумма осталась, обновляем статус
                Payment::where('id', $payment_id)->update(['status' => 'неоплачен']);
            }

            return redirect()->back()->with('success', 'Платеж успешно удален.');

        }
        else{
            // Получаем ID платежа перед удалением
            $payment_id = $paymentMov->payments_id;


            // Удаляем запись из таблицы payment_mov
            $paymentMov->delete();



            // Проверяем, есть ли еще связанные записи
            $hasRelatedPayments = payment_mov::where('payments_id', $payment_id)->exists();

            if (!$hasRelatedPayments) {
                // Обновляем статус в таблице Payment на 'неоплачен'
                Payment::where('id', $payment_id)->update(['status' => 'неоплачен']);
            }

            // Подсчитываем сумму с использованием агрегатной функции
            $sumAllSvet = Payment::where('id', $payment_id)->sum('sum');
            $sumPay = payment_mov::where('payments_id', $payment_id)->sum('sum');
            $sumleft = $sumAllSvet - $sumPay;

            if ($hasRelatedPayments && $sumleft > 0) {
                // Если есть связанные платежи и сумма осталась, обновляем статус
                Payment::where('id', $payment_id)->update(['status' => 'неоплачен']);
            }

            return redirect()->back()->with('success', 'Платеж успешно удален.');
        }



    }
}
