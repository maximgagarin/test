<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class DebtsController extends Controller
{
    public function index()
    {


        $query = "
        SELECT
            areas.id,
            areas.number,
            (
                SELECT COALESCE(SUM(payments.sum), 0)
                FROM payments
                WHERE payments.areas_id = areas.id and payments.status = 'неоплачен'
            ) AS total_payments_sum,
            (
                SELECT COALESCE(SUM(payment_movs.sum), 0)
                FROM payments
                LEFT JOIN payment_movs ON payments.id = payment_movs.payments_id
                WHERE payments.areas_id = areas.id and payments.status = 'неоплачен'
            ) AS total_payment_movs_sum
        FROM
            areas ORDER BY total_payments_sum DESC
    ";




        $results = DB::select($query);
        $total = 0;
        foreach ($results as $result){
            $total = $total + ($result->total_payments_sum - $result->total_payment_movs_sum);
        }
        $formattedTotal = number_format($total, 2, ',', ' ');
        return view('debts', compact('results', 'formattedTotal'));
    }



    public function index2()
    {

        $data = request();
        //$value = $data['value'];

        if(isset($data['type'])) {
           // dd($data['type']);
            $type = $data['type'];
            $query = "
        SELECT
            areas.id,
            areas.number,
            (
                SELECT COALESCE(SUM(payments.sum), 0)
                FROM payments
                WHERE payments.areas_id = areas.id and payments.status = 'неоплачен'  AND payments.type = '$type'
            ) AS total_payments_sum,
            (
                SELECT COALESCE(SUM(payment_movs.sum), 0)
                FROM payments
                LEFT JOIN payment_movs ON payments.id = payment_movs.payments_id
                WHERE payments.areas_id = areas.id and payments.status = 'неоплачен'  AND payments.type = '$type'
            ) AS total_payment_movs_sum
        FROM
            areas ORDER BY total_payments_sum DESC
    ";
            $results = DB::select($query);


            $total = 0;
            foreach ($results as $result){
                $total = $total + ($result->total_payments_sum - $result->total_payment_movs_sum);
            }



            $formattedTotal = number_format($total, 2, ',', ' ');

            return view('debts', compact('results', 'formattedTotal'));
        }
    }

}
