<?php

namespace App\View\Components;

use App\Models\Payment;
use Illuminate\View\Component;

class Tablepay extends Component
{
    public $payments2;
    public $id;
    public function __construct($id)

    {
        $this->id=$id;
        $query = Payment::join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.areas_id', $id->id)
            ->where('payment_movs.sum', '>' ,0)
            ->select('payment_movs.payments_id', 'payment_movs.sum', 'payments.type', 'payment_movs.date')
            ->orderBy('payment_movs.date', 'asc')
            ->get();
        $this->payments2=$query;
    }


    public function render()
    {
        return view('components.tablepay');
    }
}
