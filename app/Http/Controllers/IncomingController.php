<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Incoming;
use App\Models\Prepay;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $lastIdIncoming = Incoming::latest()->value('id');

        if (isset($data['sum_left'])){
            $dataPrepay=[
                'sum'=>$data['sum_left'],
                'areas_id'=>$areas_id,
                'date'=>now(),
                'saldo'=>'приход',
            ];
            Prepay::create($dataPrepay);
        }

        if (isset($data['svet']))
        {
            $type = 'свет';
            $value=$data['svet'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('areas_id', $areas_id)->update(['svet' => $value]);
        }
        if (isset($data['chvznos']))
        {
            $type = 'чвзнос';
            $value=$data['chvznos'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('areas_id', $areas_id)->update(['chvznos' => $value]);
        }
        if (isset($data['trash']))
        {
            $type = 'мусор';
            $value=$data['trash'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('areas_id', $areas_id)->update(['trash' => $value]);
        }
        if (isset($data['road']))
        {
            $type = 'дороги';
            $value=$data['road'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('areas_id', $areas_id)->update(['road' => $value]);
        }
        if (isset($data['camera']))
        {
            $type = 'видеонаблюдение';
            $value=$data['road'];
            calculation($areas_id, $value, $type, $lastIdIncoming);
            Incoming::where('areas_id', $areas_id)->update(['camera' => $value]);
        }
        return redirect()->back();


    }


}
