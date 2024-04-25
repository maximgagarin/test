<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Incoming;
use App\Models\Payment;
use App\Models\payment_mov;
use App\Models\Prepay;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use function Sodium\compare;

class IncomingController extends Controller
{
    public function index()
    {


        $data = \request()->validate([
            'alldebt' => '',
            'sum_left' => 'numeric',
            'sum_paid' => 'numeric',
            'sum_incoming' => 'numeric',
            'svet' => 'numeric',
            'chvznos' => 'numeric',
            'trash' => 'numeric',
            'road' => 'numeric',
            'blag' => 'numeric',
            'areas_id' => 'numeric',
            'date' => 'date',
            'svetdebt' => '',
            'chvznosdebt' => '',
            'roaddebt' => '',
            'trashdebt' => '',
            'blagdebt' => '',
        ]);



        if($data['svet'] > $data['svetdebt']  or $data['chvznos'] > $data['chvznosdebt']
            or $data['road'] > $data['roaddebt'] or $data['trash'] > $data['trashdebt'] or $data['blag'] > $data['blagdebt'] ){
            return  redirect()->back()->with('danger', 'Превышеная сумма по платежу');
        }

        $alldebt = $data['alldebt'];


        $sum_left = $data['sum_left'];
        $sum_paid = $data['sum_paid'];
        $sum_incoming = $data['sum_incoming'];
        $areas_id = $data['areas_id'];
        $date = $data['date'];


        if($sum_incoming < $alldebt && $sum_paid < $sum_incoming ||
            $sum_incoming>$alldebt && $sum_paid < $alldebt ||
            $sum_incoming < $alldebt && $sum_paid < $sum_incoming ||
            $sum_paid>$alldebt){
            return redirect()->back()->with('danger', 'Не добавлено , проверьте данные');
        }

        $incoming_data =[
            'areas_id' =>$areas_id,
            'sum_incoming' =>$sum_incoming,
            'sum_left' =>$sum_left,
            'sum_paid' =>$sum_paid,
            'date' =>$date,
        ];
        Incoming::create($incoming_data);
        $lastIdIncoming =  Incoming::latest('id')->value('id');

        if (isset($data['sum_left'])){
            $dataPrepay=[
                'sum'=>$data['sum_left'],
                'areas_id'=>$areas_id,
                'date'=>now(),
                'saldo'=>'приход',
                'incoming' => $lastIdIncoming
            ];
            Prepay::create($dataPrepay);
        }

        if (($data['svet']))
        {
            $type = 'энергия';
            $value=$data['svet'];

            calculation($areas_id, $value, $type, $lastIdIncoming, $date);
            Incoming::where('id',  $lastIdIncoming)->update(['svet' => $value]);

        }
        if (($data['chvznos']))
        {

            $type = 'чвзнос';
            $value=$data['chvznos'];
            calculation($areas_id, $value, $type, $lastIdIncoming, $date);
            Incoming::where('id',  $lastIdIncoming)->update(['chvznos' => $value]);

        }
        if (($data['trash']))
        {
            $type = 'мусор';
            $value=$data['trash'];
            calculation($areas_id, $value, $type, $lastIdIncoming, $date);
            Incoming::where('id',  $lastIdIncoming)->update(['trash' => $value]);

        }
        if (($data['road']))
        {
            $type = 'дороги';
            $value=$data['road'];
            calculation($areas_id, $value, $type, $lastIdIncoming, $date);
            Incoming::where('id',  $lastIdIncoming)->update(['road' => $value]);

        }
        if (($data['blag']))
        {
            $type = 'благоустройство';
            $value=$data['blag'];
            calculation($areas_id, $value, $type, $lastIdIncoming, $date);
            Incoming::where('id',  $lastIdIncoming)->update(['camera' => $value]);

        }
        return redirect()->back()->with('success', 'Добавлено');

    }

    public function all()
    {

        $data = \request();
        $date = \request('date');
        if($data['date1']) {
            $startDate = $data['date1'];
            $endDate = $data['date2'];
            $endDatePlus = date('Y-m-d', strtotime($endDate . ' +1 day'));

            $results = Incoming::leftJoin('areas', 'areas.id', '=', 'incomings.areas_id')
                ->select('incomings.created_at', 'incomings.date', 'incomings.sum_incoming', 'incomings.sum_left', 'incomings.sum_paid',
                    'incomings.svet', 'incomings.chvznos', 'incomings.trash', 'incomings.road', 'incomings.camera', 'incomings.areas_id', 'areas.number','areas.name')
                ->whereBetween('incomings.date', [$startDate, $endDate])

                ->get();

            return view('incoming', compact('results', 'startDate', 'endDate' ));
        }



        $results = Incoming::leftJoin('areas', 'areas.id', '=', 'incomings.areas_id')
            ->select('incomings.created_at', 'incomings.date', 'incomings.sum_incoming', 'incomings.sum_left', 'incomings.sum_paid',
                'incomings.svet', 'incomings.chvznos', 'incomings.trash', 'incomings.road', 'incomings.camera', 'incomings.areas_id', 'areas.number', 'areas.name')
            ->whereDate('incomings.date', $date)

            ->get();


        return view('incoming', compact('results' ));
    }

    public function destroy()
    {
        $id = \request('id');

// Step 1: Retrieve payments based on a condition
        $payments = Payment::whereHas('payment_mov', function ($query) use ($id) {
            $query->where('incoming', $id);
        })->get();

// Step 2: Find and delete an incoming record with a specific ID
        $incoming = Incoming::find($id);
        if ($incoming) {
            $incoming->delete();
        }

// Step 3: Delete related records in Prepay and payment_mov tables based on the incoming ID
        Prepay::where('incoming', $id)->delete();
        payment_mov::where('incoming', $id)->delete(); // Ensure the correct capitalization

// Step 4: Update the status column of the retrieved payments to 'неоплачен'
        $payments->each(function ($payment) {
            $payment->update(['status' => 'неоплачен']);
        });


        return redirect()->back();
    }

    public function print()
    {

      $startDate=\request('startDate');
      $endDate=\request('endDate');

        $endDatePlus = date('Y-m-d', strtotime($endDate . ' +1 day'));

        $results = Incoming::leftJoin('areas', 'areas.id', '=', 'incomings.areas_id')
            ->select('incomings.created_at', 'incomings.date', 'incomings.sum_incoming', 'incomings.sum_left', 'incomings.sum_paid',
                'incomings.svet', 'incomings.chvznos', 'incomings.trash', 'incomings.road', 'incomings.camera', 'incomings.areas_id', 'areas.number','areas.name')
            ->whereBetween('incomings.date', [$startDate, $endDatePlus])
            ->orderby('incomings.date')
            ->get();

        return view('incoming-print', compact('results', 'startDate', 'endDate' ));
    }
}
