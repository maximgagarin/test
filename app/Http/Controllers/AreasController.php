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

    public function comment()
    {
      $id = \request('id');
      $text = \request('text');
        Area::where('id', $id)->update(['comment' => $text]);
        return redirect()->back();
    }
    public function update2()
    {
        $data = request()->all(); // Получаем все данные из запроса

        $id = $data['id'];

        $updatedData = [
            'number' => $data['number'],
            'name' => $data['name'],
            'address' => $data['address'],
            'telephone' => $data['telephone'],
            'square' => $data['square'],
        ];

        Area::where('id', $id)->update($updatedData);

        return redirect()->route('dashboard', compact('id'));
    }

}