<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function order(Request $request) {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required',
                'date' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa nhập email',
                'date.required' => 'Bạn chưa nhập ngày tháng'
            ]
        );

        $id = Order::create($request->All());
        if($id) {
            return redirect()->route('/')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Book Food']);
        }
    }

    public function show() {
        $title = 'Order';
        $list = Order::select('*')->get();
        return view('admin.order.list', ['list' => $list, 'title' => $title]);
    }
}
