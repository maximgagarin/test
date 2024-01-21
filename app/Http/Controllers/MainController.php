<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Counter;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use function Sodium\compare;

class MainController extends Controller
{
    public function index()
    {

        $data = request();
        $value = $data['value'];
        $query = Area::query();
        if(isset($data['value'])) {
            $query->where('name', 'like', "%{$data['value']}%");
            $areas = $query->get();
        }
        else{
            $areas = Area::all();
        }
        return view('main', compact('areas', 'value'));
    }




}
