<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class MainController extends Controller
{
    public function index()
    {

        $value = request()->input('value');
        $query = Area::query();

        if ($value) {
            $query->where('name', 'like', "%{$value}%");
        }

        $areas = $query->paginate(350);

        return view('main', compact('areas', 'value'));
    }


    public function search()
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
            areas;
    ";

        $result = DB::select($query);


        return view('name', compact('result'));
    }

}
