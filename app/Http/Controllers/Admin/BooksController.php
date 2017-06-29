<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toolbar;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BookCreateRequest;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->toolBar = new ToolBar();
    }
    /*i custom*/
    public function order(BookCreateRequest $request) {
        $id = Order::create($request->All());
        if($id) {
            return redirect()->route('/')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Book Food']);
        }
    }

    public function listData() {
        $title = 'Order';
        $this->toolBar->deleteItem = 'add';
        $button = $this->toolBar->showButton('List');
        $list = Order::paginate(10);
        return view('admin.order.list', ['list' => $list, 'title' => $title, 'button' => $button]);
    }

    public function editR($id) {
        $this->toolBar->deleteItem = 'save-add';
        $button = $this->toolBar->showButton('Detail');
        $title = 'Edit Item';
        $data = Order::findOrFail($id);
        $number_person = [
            1 => 'one person',
            2 => 'two persons',
            3 => 'three persons',
            4 => 'four persons',
            5 => 'five persons'
        ];
        return view('admin.order.detail', ['title' => $title, 'button' => $button, 'data' => $data, 'number_person' => $number_person]);
    }

    public function updateCate($request, $id) {
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
        $existName = Order::where('name', $request->name)->count();
        if($existName && $request->name != $request->name_old) {
            return false;
        }
        $order = Order::find($id);
        $fields = $order->getFillable();
        foreach ($fields as $field) {
            $order->$field = $request->$field;
        }
        return $order->save();
    }

    public function remove($id) {
        return Order::destroy($id);
    }

    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        switch ($task) {
            case 'apply':
                $this->updateCate( $request, $id);
                return redirect()->route('admin.order.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Menu Item']);
            case 'save':
                $this->updateCate($request, $id);
                return redirect()->route('admin.order.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Menu Item']);
            case 'edit':
                $id = $id[0];
                return redirect()->route('admin.order.getEditCate', ['id' => $id]);
            case 'remove':
                $this->remove($id);
                return redirect()->route('admin.order.listData')->with(['flash_level' => 'success', 'flash_message' => 'Delete success']);
            case 'back':
                return redirect()->route('admin.order.listData');
            default:
                return redirect()->route('admin.order.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);
        }
    }
}
