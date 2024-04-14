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
        $type = '';
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
            areas HAVING total_payments_sum>0 ORDER BY total_payments_sum DESC
    ";
        $results = DB::select($query);


//пагинация
        $page = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
        $perPage = 100; // Number of items per page
        $total = count($results);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            array_slice($results, ($page - 1) * $perPage, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );



        $total = 0;
        foreach ($results as $result){
            $total = $total + ($result->total_payments_sum - $result->total_payment_movs_sum);
        }
        $formattedTotal = number_format($total, 2, ',', ' ');
        return view('debts', compact('results', 'formattedTotal' , 'type', 'paginator'));
    }



    public function index2()
    {
        $data = request();
        if(isset($data['type'])) {
            $type = $data['type'];
//            $results = DB::table('areas')
//                ->select('areas.id', 'areas.number')
//                ->selectRaw('COALESCE(SUM(payments.sum), 0) AS total_payments_sum')
//                ->selectRaw('COALESCE(SUM(payment_movs.sum), 0) AS total_payment_movs_sum')
//                ->leftJoin('payments', 'payments.areas_id', '=', 'areas.id')
//                ->leftJoin('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
//                ->where('payments.status', 'неоплачен')
//                ->where('payments.type', $type)
//                ->groupBy('areas.id', 'areas.number')
//                ->orderByDesc('total_payments_sum')
//                ->get();

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
            areas HAVING total_payments_sum>0 ORDER BY total_payments_sum DESC
    ";
            $results = DB::select($query);

//пагинация
            $page = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
            $perPage = 100; // Number of items per page
            $total = count($results);

            $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                array_slice($results, ($page - 1) * $perPage, $perPage),
                $total,
                $perPage,
                $page,
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
            );


            $total = 0;
            foreach ($results as $result){
                $total = $total + ($result->total_payments_sum - $result->total_payment_movs_sum);
            }
            $formattedTotal = number_format($total, 2, ',', ' ');

            $test =    Area::has('paymentsmovs')->withSum('paymentsmovs', 'sum')->get();


            return view('debts', compact('results', 'formattedTotal', 'type', 'test' ,'paginator'));
        }
    }

}
