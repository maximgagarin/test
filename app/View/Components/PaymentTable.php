<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Payment;

class PaymentTable extends Component
{
    public $payments;
    public $type;
    public $id;

    public function __construct($type, $id)
    {
        $this->type = $type;
        $this->id = $id;
        $this->payments = Payment::withSum('payment_mov as sumpaid', 'sum')
            ->where('areas_id', $id->id)
            ->where('type', $type)
        //    ->where('status', 'неоплачен')
            ->get();
    }

    public function render()
    {
        return view('components.payment-table');
    }
}
