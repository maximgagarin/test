<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Payment;
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
            'amount' => '',
            'tariff' => '',
            'sum' => '',
        ]);

        $data['areas_id'] = $id;
        $data['type'] = 'свет';
        $data['unit'] = 'квт';
        $data['status'] = 'свет';
        $data['date'] = '2012-12-12';

        Payment::create($data);

        return redirect()->route('dashboard', compact('id'));
    }

    public function pay($id)
    {

        $data = request()->validate([
            'value' => '',
        ]);

        $TypePayment = 'свет';
        $payments = Payment::select(['id', 'sum'])
            ->where('areas_id', $id)
            ->where('type', 'свет')
            ->get();

    }
}
