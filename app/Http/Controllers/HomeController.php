<?php

namespace App\Http\Controllers;

use App\Models\CateFood;
use App\Models\Food;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show() {
        $menu = Menu::select('*')->get();
        $cates = CateFood::select('*')->get();
        $list = Food::select('*')->get();
        return view('code.index', ['menu' => $menu, 'cates' => $cates, 'list' => $list]);
    }
}
