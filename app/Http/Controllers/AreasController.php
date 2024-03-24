<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Models\Payment;
use App\Models\tariff;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function update($id)
    {
        $result = Area::find($id);
        //dd($result);
        return view('areaupdate', compact('result'));

   }

    public function new()
    {
        $number = \request('number');
        $square = \request('square');

        return view('areanewowner', compact('number','square'));

    }

    public function comment()
    {
      $id = \request('id');
      $text = \request('text');
        Area::where('id', $id)->update(['comment' => $text]);
        return redirect()->back();
    }
    public function update2()
    {

        $data = request()->validate([
            'number' => ['string'],
            'name' => ['string'],
            'address' => ['string'],
            'telephone' => ['string'],
            'square' => ['numeric'],
            'id' => ['numeric'],
        ]);
        $id = $data['id'];
        $data['balance'] = 0;


        Area::where('id', $id)->update($data);

        return redirect()->route('dashboard', compact('id'));
    }

    public function create()
    {
        return view('areacreate');
    }

    public function store()
    {
        $data = request()->validate([
            'number' => ['string'],
            'name' => ['string'],
            'address' => ['string'],
            'telephone' => ['string'],
            'square' => ['numeric'],

        ]);
        $data['balance'] = 0;

//        $data = [
//            'number' => \request('number'),
//            'name' => \request('name'),
//            'address' => \request('address'),
//            'telephone' => \request('telephone'),
//            'square' => \request('square'),
//            'balance' => 0,
//        ]   ;
        Area::create($data);
        return redirect()->route('main');
    }

}
