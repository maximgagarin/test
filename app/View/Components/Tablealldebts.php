<?php

namespace App\View\Components;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Tablealldebts extends Component
{
    public $svet;
    public $chvznos;
    public $road;
    public $camera;
    public $trash;
    public $id;
    public function __construct($id)
    {
        $this->id=$id;
        $sumPaidSvet =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'свет')
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
            ->sum('payment_movs.sum');
        $sumAllSvet = Payment::where('areas_id', $id->id)->where('type', 'свет')->where('status', 'неоплачен')->sum('sum');
        $sumLeft = $sumAllSvet - $sumPaidSvet;
        $this->svet=$sumLeft;

        $sumPaid2 =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'чвзнос')
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
            ->sum('payment_movs.sum');
        $sumAll2 = Payment::where('areas_id', $id->id)->where('type', 'чвзнос')->where('status', 'неоплачен')->sum('sum');
        $sumLeft2 = $sumAll2 - $sumPaid2;
        $this->chvznos=$sumLeft2;

        $sumPaid3 =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'дороги')
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
            ->sum('payment_movs.sum');
        $sumAll3 = Payment::where('areas_id', $id->id)->where('type', 'дороги')->where('status', 'неоплачен')->sum('sum');
        $sumLeft3 = $sumAll3 - $sumPaid3;
        $this->road=$sumLeft3;

        $sumPaid4 =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'видеокамеры')
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
            ->sum('payment_movs.sum');
        $sumAll4 = Payment::where('areas_id', $id->id)->where('type', 'видеокамеры')->where('status', 'неоплачен')->sum('sum');
        $sumLeft4 = $sumAll4 - $sumPaid4;
        $this->camera=$sumLeft4;

        $sumPaid5 =DB::table('payments')
            ->Join('payment_movs', 'payments.id', '=', 'payment_movs.payments_id')
            ->where('payments.type', 'мусор')
            ->where('areas_id', $id->id)
            ->where('status', 'неоплачен')
            ->sum('payment_movs.sum');
        $sumAll5 = Payment::where('areas_id', $id->id)->where('type', 'мусор')->where('status', 'неоплачен')->sum('sum');
        $sumLeft5 = $sumAll5 - $sumPaid5;
        $this->trash=$sumLeft5;




    }


    public function render()
    {
        return view('components.tablealldebts');
    }
}
