<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toolbar;
use App\Http\Controllers\Controller;
use App\Models\CateFood;
use App\Models\Food;
use Illuminate\Http\Request;

use App\Http\Requests;


class FoodsController extends Controller
{
    public function __construct()
    {
        $this->toolBar = new ToolBar();
    }
    /*i custom*/
    public function listData() {
        $button = $this->toolBar->showButton('List'); /*tham số truyền vào 2 giá trị là "List" và "Detail" tương ứng với 2 function*/
        $title = 'List Food';
        $list = Food::paginate(10);
        return view('admin.food.food.list', ['title' => $title, 'button' => $button, 'list' => $list]);
    }

    public function detail() {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Add Food';
        $cates = CateFood::select('id', 'name')->get();
        return view('admin.food.food.detail', ['title' => $title, 'button' => $button, 'cates' => $cates]);
    }

    public function editR($id) {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Edit Item';
        $data = Food::findOrFail($id);
        $cates = CateFood::select('id', 'name')->get();
        return view('admin.food.food.detail', ['title' => $title, 'button' => $button, 'data' => $data, 'cates' => $cates]);
    }

    public function save($request, $food) {
        $this->validate($request,
            [
                'name' => 'bail|required|unique:foods,name'
            ],
            [
                'name.required' => 'Please enter food',
                'name.unique' => 'The name item is exist'
            ]
        );
        $fields = $food->getFillable();
        foreach ($fields as $field) {
            $food->$field = $request->$field;
        }
        $food->alias = $request->alias ? $request->alias : stringStandart($request->name);
        $food->save();
        return $food->id;
    }

    /*function update cat*/
    public function updateCate($request, $id) {
        $this->validate($request,
            [
                'name' => 'required|',
                'price' => 'required',
                'cate_id' => 'required',
            ],
            [
                'name.required' => 'Please enter name',
                'price.required' => 'Please enter price',
                'cate_id.different' => 'Please enter category',

            ]
        );
        $existName = Food::where('name', $request->name)->count();
        if($existName && $request->name != $request->name_old) {
            return false;
        }
        $food = Food::find($id);
        $fields = $food->getFillable();
        foreach ($fields as $field) {
            $food->$field = $request->$field;
        }
        $food->alias = $request->alias ? $request->alias : stringStandart($request->name);

        return $food->save();
    }

    public function save_all($request) {
        $total = $request->total;
        if (!$total)
            return true;
        $field_change = $request->field_change;
        if (!$field_change)
            return false;
        $field_change_arr = explode(',', $field_change);
        $total_field_change = count($field_change_arr);
        $record_change_success = 0;
        for ($i = 0; $i < $total; $i++){
            $row = array();
            $update = 0;

            foreach ($field_change_arr as $field_item){
                $orginal = $field_item . '_' . $i . '_original';
                $field_value_original = $request->$orginal;
                $new = $field_item . '_' . $i;
                $field_value_new = $request->$new;
                if (is_array($field_value_new))
                    $field_value_new = count($field_value_new) ? ',' . implode(',', $field_value_new).',' : '';
                if ($field_value_original != $field_value_new){
                    $update = 1;
                    $row[$field_item] = $field_value_new;
                }
            }

            if ($update){
                $id_ = 'id_' . $i;
                $id = $request->$id_;
                Food::where('id', $id)->update($row);
                $record_change_success++;
            }
        }
        return $record_change_success;
    }

    public function remove($id) {
        return Food::destroy($id);
    }

    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        $food = new Food();
        if(!$id) {
            return $this->taskWithOutId($task, $request, $food);
        } else {
            return $this->taskWithId($task, $request, $id);
        }
    }

    public function taskWithOutId($task, $request, $food) {
        switch ($task) {
            case 'save-add':
                $this->save($request, $food);
                return redirect()->route('admin.food.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Food']);
            case 'apply':
                $id = $this->save($request, $food);
                return redirect()->route('admin.food.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Food']);
            case 'save':
                $this->save($request, $food);
                return redirect()->route('admin.food.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Menu item']);
            case 'add':
                return redirect()->route('admin.food.getAddCate');
            case 'save_all':
                $id = $this->save_all($request);
                if($id) {
                    return redirect()->route('admin.food.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Save All Foods']);
                } else {
                    return redirect()->route('admin.food.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Not Save']);
                }
            case 'back':
                return redirect()->route('admin.food.listData');
            default:
                return redirect()->route('admin.food.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);
        }
    }

    public function taskWithId($task, $request, $id) {
        switch ($task) {
            case 'save-add':
                $this->updateCate($request, $id);
                return redirect()->route('admin.food.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Food']);
            case 'apply':
                $this->updateCate($request, $id);
                return redirect()->route('admin.food.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Food']);
            case 'save':
                $this->updateCate($request, $id);
                return redirect()->route('admin.food.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Food']);
            case 'edit':
                $id = $id[0];
                return redirect()->route('admin.food.getEditCate', ['id' => $id]);
            case 'remove':
                $this->remove($id);
                return redirect()->route('admin.food.listData')->with(['flash_level' => 'success', 'flash_message' => 'Delete success']);
            case 'back':
                return redirect()->route('admin.food.listData');
            default:
                return redirect()->route('admin.food.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);
        }
    }
}
