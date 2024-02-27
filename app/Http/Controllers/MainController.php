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
        $value = request()->input('value');
        $query = Area::query();
        if ($value) {
            $query->where('name', 'like', "%{$value}%");
        }
        $areas = $query->paginate(350);
        return view('main', compact('areas'));
    }



}
