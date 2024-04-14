<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class MainController extends Controller
{
    public function index()
    {


        // Проверка наличия данных для поиска по имени
        if (request()->filled('SearchByName')) {
            $areas =  Area::where('name', 'like', '%' . request('SearchByName') . '%')->paginate(350);
            return view('main', compact('areas'));
        }

        // Проверка наличия данных для поиска по номеру
        if (request()->filled('SearchByNumber')) {
            $areas =  Area::where('number', 'like', '%' . request('SearchByNumber') . '%')->paginate(350);
            return view('main', compact('areas'));
        }

        $areas = Area::paginate(350);
        return view('main', compact('areas'));
    }
}
