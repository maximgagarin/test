<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Incoming;
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
        $data = \request();
        $sum_left = $data['sum_left'];
        $sum_paid = $data['sum_paid'];
        $sum_incoming = $data['sum_incoming'];
        $areas_id = $data['areas_id'];
        $date = $data['date'];

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
            ];
            Prepay::create($dataPrepay);
        }

        if (($data['svet']))
        {

            $type = 'свет';
            $value=$data['svet'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('id',  $lastIdIncoming)->update(['svet' => $value]);
        }
        if (($data['chvznos']))
        {
            $type = 'чвзнос';
            $value=$data['chvznos'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('id',  $lastIdIncoming)->update(['chvznos' => $value]);
        }
        if (($data['trash']))
        {
            $type = 'мусор';
            $value=$data['trash'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('id',  $lastIdIncoming)->update(['trash' => $value]);
        }
        if (($data['road']))
        {
            $type = 'дороги';
            $value=$data['road'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('id',  $lastIdIncoming)->update(['road' => $value]);
        }
        if (($data['camera']))
        {
            $type = 'видеонаблюдение';
            $value=$data['camera'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('id',  $lastIdIncoming)->update(['camera' => $value]);
        }
        return redirect()->back();

    }

    public function all()
    {
        $data = \request();
        $date = \request('date');
        if($data['date1']) {
            $startDate = $data['date1'];
            $endDate = $data['date2'];
           // $results = Incoming::whereBetween('created_at', [$startDate, $endDate])->get();
            $results = Incoming::leftJoin('areas', 'areas.id', '=', 'incomings.areas_id')
                ->select('incomings.created_at', 'incomings.date', 'incomings.sum_incoming', 'incomings.sum_left', 'incomings.sum_paid',
                    'incomings.svet', 'incomings.chvznos', 'incomings.trash', 'incomings.road', 'incomings.camera', 'incomings.areas_id', 'areas.number')
                ->whereBetween('incomings.created_at', [$startDate, $endDate])
                ->get();

            return view('incoming', compact('results' ));
        }


       // $results = Incoming::whereDate('created_at', $date)->get();
        $results = Incoming::leftJoin('areas', 'areas.id', '=', 'incomings.areas_id')
            ->select('incomings.created_at', 'incomings.date', 'incomings.sum_incoming', 'incomings.sum_left', 'incomings.sum_paid',
                'incomings.svet', 'incomings.chvznos', 'incomings.trash', 'incomings.road', 'incomings.camera', 'incomings.areas_id', 'areas.number')
            ->whereDate('incomings.created_at', $date)
            ->get();


        return view('incoming', compact('results' ));
    }
}
