<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toolbar;
use App\Helper\Tree;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

use App\Http\Requests;

class MenusController extends Controller
{


    public function __construct()
    {
        $this->toolBar = new ToolBar();
    }

    /*i custom*/
    public function listData() {
        $button = $this->toolBar->showButton('List');
        $title = 'Menu Items';
        $list = Menu::paginate(10);
        return view('admin.menu.menuItems.list', ['title' => $title, 'button' => $button, 'list' => $list]);
    }

    public function detailCate() {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Menu Items';
        $parent = Menu::select('id', 'name', 'parent_id')->get();
        $tree = new Tree();
        $cates = $tree->indentRows2($parent);
        return view('admin.menu.menuItems.detail', ['title' => $title, 'button' => $button, 'cates' => $cates]);
    }

    public function editCate($id) {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Edit';
        $data = Menu::findOrFail($id);
        $cates = '';
        if(isset($data->parent_id)) {
            $parent = Menu::select('id', 'name', 'parent_id')->get();
            $tree = new Tree();
            $cates = $tree->indentRows2($parent);
        }
        return view('admin.menu.menuItems.detail', ['title' => $title, 'button' => $button, 'data' => $data, 'cates' => $cates]);
    }

    public function save($request, $menu) {
        $this->validate($request,
            [
                'name' => 'bail|required|unique:menus,name'
            ],
            [
                'name.required' => 'Please enter item name',
                'name.unique' => 'The name item is exist'
            ]
        );
        $fields = $menu->getFillable();
        foreach ($fields as $field) {
            $menu->$field = $request->$field;
        }

        $menu->alias = $request->alias ? $request->alias : stringStandart($request->name);
        $menu->save();
        if($request->has('list_parents')) {
            Menu::whereId(Menu::id)->update(['list_parents' => ",$this->model->id,"]);
        }
        return $menu->id;
    }
    public function updateCate($request, $id) {
        $this->validate($request,
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'Please enter item name'

            ]
        );

        $existName = Menu::where('name', $request->name)->count();
        if($existName && $request->name != $request->name_old) {
            return false;
        }
        $menu = Menu::find($id);
        $fields = $menu->getFillable();
        foreach ($fields as $field) {
            $menu->$field = $request->$field;
        }
        $menu->alias = $request->alias ? $request->alias : stringStandart($request->name);
        if($request->parent_id != 0) {
            $parent = Menu::select('list_parents')->whereId($request->parent_id)->first();
            if(strpos($parent->list_parents, $request->id) == true) {
                return false;
            }
            $menu->list_parents = $parent->list_parents . $request->id . ',';

        } else {
            $menu->list_parents = ",$request->id,";
        }
        return $menu->save();
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
                Menu::where('id', $id)->update($row);
                $record_change_success++;
            }
        }
        return $record_change_success;
    }

    public function remove($id) {
        return Menu::destroy($id);
    }
    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        $menu = new Menu();
        if(!$id) {
            return $this->taskWithOutId($task, $request, $menu);
        } else {
            return $this->taskWithId($task, $request, $id);
        }
    }

    public function taskWithOutId($task, $request, $menu) {
        switch ($task) {
            case 'save-add':
                $this->save($request, $menu);
                return redirect()->route('admin.menu.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Menu Item']);
            case 'apply':
                $id = $this->save($request, $menu);
                return redirect()->route('admin.menu.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Menu Item']);
            case 'save':
                $this->save($request, $menu);
                return redirect()->route('admin.menu.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Menu item']);
            case 'add':
                return redirect()->route('admin.menu.getAddCate');
            case 'save_all':
                $id = $this->save_all($request);
                if($id) {
                    return redirect()->route('admin.menu.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Save All Menu Items']);
                } else {
                    return redirect()->route('admin.menu.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Not Save']);
                }
            case 'back':
                return redirect()->route('admin.menu.listData');
            default:
                return redirect()->route('admin.menu.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);
        }
    }

    public function taskWithId($task, $request, $id) {
        switch ($task) {
            case 'save-add':
                $this->updateCate($request, $id);
                return redirect()->route('admin.menu.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Items']);
            case 'apply':
                $this->updateCate($request, $id);
                return redirect()->route('admin.menu.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Menu Item']);
            case 'save':
                $this->updateCate($request, $id);
                return redirect()->route('admin.menu.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Menu Item']);
            case 'edit':
                $id = $id[0];
                return redirect()->route('admin.menu.getEditCate', ['id' => $id]);
            case 'remove':
                $this->remove($id);
                return redirect()->route('admin.menu.listData')->with(['flash_level' => 'success', 'flash_message' => 'Delete success']);
            case 'back':
                return redirect()->route('admin.menu.listData');
            default:
                return redirect()->route('admin.menu.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);
        }
    }
}
