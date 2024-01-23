<?php

namespace App\View\Components;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Tablesumpayment extends Component
{
    public $payments;
    public $type;
    public $id;
    public function __construct($type, $id)
    {
        $this->type = $type;
        $this->id = $id;

        $sumPaidSvet =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', $type)
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
            ->sum('payment_movs.sum');
        $sumAllSvet = Payment::where('areas_id', $id->id)->where('type', $type)->where('status', 'неоплачен')->sum('sum');
        $sumLeft = $sumAllSvet - $sumPaidSvet;
        $this->payments=$sumLeft;
    }


    public function render()
    {
        return view('components.tablesumpayment');
    }
}
