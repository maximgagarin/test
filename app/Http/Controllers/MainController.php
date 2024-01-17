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
        //$last = Counter::latest('id')->value('value');

        $all = Area::all();
        return view('main', compact('all'));
    }


}
