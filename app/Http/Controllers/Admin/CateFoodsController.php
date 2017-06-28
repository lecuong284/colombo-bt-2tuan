<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toolbar;
use App\Http\Controllers\Controller;
use App\Models\CateFood;
use Illuminate\Http\Request;

use App\Http\Requests;


class CateFoodsController extends Controller
{
    public function __construct()
    {
        $this->toolBar = new ToolBar();
    }
    /*i custom*/
    public function listData() {
        $button = $this->toolBar->showButton('List');
        $title = 'Category Food';
        $list = CateFood::paginate(10);
        return view('admin.food.cateFood.list', ['title' => $title, 'button' => $button, 'list' => $list]);
    }

    public function detail() {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Add Categories Food';
        return view('admin.food.cateFood.detail', ['title' => $title, 'button' => $button]);
    }

    public function editR($id) {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Category edit';
        $data = CateFood::findOrFail($id);
        return view('admin.food.cateFood.detail', ['title' => $title, 'button' => $button, 'data' => $data]);
    }

    public function save($request, $cateFood) {
        $this->validate($request,
            [
                'name' => 'bail|required|unique:menus,name'
            ],
            [
                'name.required' => 'Please enter item name',
                'name.unique' => 'The name item is exist'
            ]
        );
        $fields = $cateFood->getFillable();
        foreach ($fields as $field) {
            $cateFood->$field = $request->$field;
        }
        $cateFood->alias = $request->alias ? $request->alias : stringStandart($request->name);
        $cateFood->save();
        return $cateFood->id;
    }

    /*function update cat*/
    public function updateCate($request, $id) {
        $this->validate($request,
            [
                'name' => 'required' /*con check trường hợp không được trùng nữa*/
            ],
            [
                'name.required' => 'Please enter category name'

            ]
        );

        $existName = CateFood::where('name', $request->name)->count();
        if($existName && $request->name != $request->name_old) { /*validate when changes the name when update*/
            return false;
        }
        $cateFood = CateFood::find($id); /*methed find thì khi không tìm thấy dữ liệu thì không báo lỗi findOrFail thì báo lỗi*/
        $fields = $cateFood->getFillable();
        foreach ($fields as $field) {
            $cateFood->$field = $request->$field;
        }
        $cateFood->alias = $request->alias ? $request->alias : stringStandart($request->name);

        return $cateFood->save();
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
                CateFood::where('id', $id)->update($row);
                $record_change_success++;
            }
        }
        return $record_change_success;
    }

    public function remove($id) {
        return CateFood::destroy($id);
    }

    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        $cateFood = new CateFood();
        if(!$id) {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $this->save($request, $cateFood);
                    return redirect()->route('admin.cateFood.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Cate Food']);

                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $id = $this->save($request, $cateFood);
                    return redirect()->route('admin.cateFood.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Cate food']);

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $this->save($request, $cateFood);
                    return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Cate food']);

                case 'add': /*chuyển đến trang thêm chi tiết*/
                    return redirect()->route('admin.cateFood.getAddCate');

                case 'save_all': /*chuyển đến trang thêm chi tiết*/
                    $id = $this->save_all($request);
                    if($id) {
                        return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Cate food']);
                    } else {
                        return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Not Save']);
                    }

                case 'back': /*trở về trang danh sách*/
                    return redirect()->route('admin.cateFood.listData');

                default:
                    return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);

            }
        } else {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.cateFood.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Category']);
                    }else {
                        return redirect()->route('admin.cateFood.getAddCate')->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }


                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.cateFood.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Cate food']);
                    }else {
                        return redirect()->route('admin.cateFood.getEditCate', ['id' => $id])->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Cate food']);
                    }else {
                        return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }

                case 'edit': /*chuyển đến trang sửa*/ /*chỉ sử dụng khi click vào checkbox rồi click button sửa*/
                    $id = $id[0];
                    return redirect()->route('admin.cateFood.getEditCate', ['id' => $id]);

                case 'remove': /*delete data*/
                    $result = $this->remove($id);
                    if($result) {
                        return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'success', 'flash_message' => 'Delete success']);
                    } else {
                        return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Exist error where delete']);
                    }

                case 'back': /*trở về trang danh sách*/
                    return redirect()->route('admin.cateFood.listData');

                default:
                    return redirect()->route('admin.cateFood.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);

            }
        }
    }
}
