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
        $debt = \request('debt');

        return view('areanewowner', compact('number','square', 'debt'));

    }

    public function comment()
    {
      $id = \request('id');
      $text = \request('text');
        Area::where('id', $id)->update(['comment' => $text]);
        return redirect()->back()->with('success', 'Сохранено');
    }
    public function update2()
    {
        // Получаем данные из запроса и валидируем их
        $data = request()->validate([
            'number' => ['string'],
//            'name' => ['string'],
//            'address' => ['string'],
//            'telephone' => ['string'],
            'square' => ['numeric'],
            'id' => ['numeric'],
            'test1' => ['string'], // Добавлено для валидации test1
        ]);

        // Извлекаем значение test1 и удаляем его из массива данных
        $test1 = $data['test1'];
        unset($data['test1']);

        $id = $data['id'];

        // Находим область по id
        $area = Area::find($id);

        // Обновляем статус в соответствии с переданным значением test1
        $area->area_status = $test1 === 'on' ? '1' : '0';

        // Обновляем остальные данные области
        $area->update($data);

        // Перенаправляемся на панель управления с передачей id
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
//            'name' => ['string'],
//            'address' => ['string'],
//            'telephone' => ['string'],
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
        return redirect()->route('main')->with('success', 'Сохранено');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id); // Find the area by ID

        // Check if payments exist for the area
        if ($area->paymentsmovs()->exists()) {
            return redirect()->back()->with('danger', 'There are associated payments. Cannot delete.');
        }

        // No payments found, proceed with deletion
        $area->delete();

        return redirect()->route('main')->with('success', 'Area deleted successfully.');
    }


}
