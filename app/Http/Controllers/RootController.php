<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Helper\Toolbar;
use App\Helper\Tree;
use App\Helper\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RootController extends Controller
{
    public function __construct()
    {
        $this->toolBar = new ToolBar();
        /*Muốn thêm button thì thêm ở đây với định dang*/
        /*$this->addButton('tên hàm được gọi','Tên hiển thị','Thông báo khi chưa chọn bản ghi','icon');*/
        //$this->md = new $this->model;

    }
    /*get list data*/
    public function listData() {
        $button = $this->toolBar->showButton('List'); /*tham số truyền vào 2 giá trị là "List" và "Detail" tương ứng với 2 function*/
        $title = 'Sản phẩm';
        $list = Cate::paginate(15);
        return view('admin.product.productCate.list', ['title' => $title, 'button' => $button, 'list' => $list]);
    }

    /*display file detail view*/
    public function detailCate() {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Category add';
        $parent = Cate::select('id', 'name', 'parent_id')->get();
        $tree = new Tree();
        $cates = $tree->indentRows2($parent);
        return view('admin.product.productCate.detail', ['title' => $title, 'button' => $button, 'cates' => $cates]);
    }

    /*get data with id and display in file detail view*/
    public function editCate($id) {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Category edit';
        $data = Cate::findOrFail($id);
        $parent = Cate::select('id', 'name', 'parent_id')->get();
        $tree = new Tree();
        $cates = $tree->indentRows2($parent);
        return view('admin.product.productCate.detail', ['title' => $title, 'button' => $button, 'data' => $data, 'cates' => $cates]);
    }

    /*All tasks save, save_add, apply, add(in list page)*/
    /**
     * @param CateRequest $cateRequest
     */
    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        $cate = new Cate();
        if(!$id) {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $this->save($request, $cate);
                    return redirect()->route('admin.cate.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Category']);

                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $id = $this->save($request, $cate);
                    return redirect()->route('admin.cate.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Category']);

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $this->save($request, $cate);
                    return redirect()->route('admin.cate.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Category']);

                case 'add': /*chuyển đến trang thêm chi tiết*/
                    return redirect()->route('admin.cate.getAddCate');

                case 'save_all': /*chuyển đến trang thêm chi tiết*/
                    $id = $this->save_all($request);
                    if($id) {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Category']);
                    } else {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Not Save']);
                    }

                case 'back': /*trở về trang danh sách*/
                    return redirect()->route('admin.cate.listData');

                default:
                    return redirect()->route('admin.cate.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);

            }
        } else {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.cate.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Category']);
                    }else {
                        return redirect()->route('admin.cate.getAddCate')->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }


                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.cate.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Category']);
                    }else {
                        return redirect()->route('admin.cate.getEditCate', ['id' => $id])->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Category']);
                    }else {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }

                case 'edit': /*chuyển đến trang sửa*/ /*chỉ sử dụng khi click vào checkbox rồi click button sửa*/
                    $id = $id[0];
                    return redirect()->route('admin.cate.getEditCate', ['id' => $id]);

                case 'remove': /*delete data*/
                    $count = Cate::whereNotIn('id', $id)->whereIn('parent_id', $id)->count();
                    if($count) {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Can not remove these records because have data are related']);
                    }
                    $result = Cate::destroy($id);
                    if($result) {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'success', 'flash_message' => 'Delete success']);
                    } else {
                        return redirect()->route('admin.cate.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Exist error where delete']);
                    }

                case 'back': /*trở về trang danh sách*/
                    return redirect()->route('admin.cate.listData');

                default:
                    return redirect()->route('admin.cate.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);

            }
        }
    }

    /*function save new*/
    /**
     * @param array $cateRequest
     * @param array $cate
     */
    public function save($request = array(), $cate = array()) {
        $this->validate($request,
            [
                'name' => 'bail|required|unique:cates,name'
            ],
            [
                'name.required' => 'Please enter category name',
                'name.unique' => 'The name category is exist'
            ]
        );
        $fields = $cate->getFillable();
        foreach ($fields as $field) {
            $cate->$field = $request->$field;
        }
        $cate->alias = $request->alias ? $request->alias : stringStandart($request->name);
        if ($request->hasFile('image')) {
            echo $this->resizeImages($request->image, $cate->alias);
            die;
        }
        $cate->save();
        /*after save, I update field "list_parents" again*/
        $cate->whereId($cate->id)->update(['list_parents' => ",$cate->id,"]);
        return $cate->id;
    }

    /*function update cat*/
    public function updateCate(Request $request, $id) {
        $this->validate($request,
            [
                'name' => 'required' /*con check trường hợp không được trùng nữa*/
            ],
            [
                'name.required' => 'Please enter category name'

            ]
        );
        $existName = Cate::where('name', $request->name)->count();
        if($existName && $request->name != $request->name_old) { /*validate when changes the name when update*/
            return false;
        }
        $cate = Cate::find($id); /*methed find thì khi không tìm thấy dữ liệu thì không báo lỗi findOrFail thì báo lỗi*/
        $fields = $cate->getFillable();
        foreach ($fields as $field) {
            $cate->$field = $request->$field;
        }
        $cate->alias = $request->alias ? $request->alias : stringStandart($request->name);
        if($request->parent_id != 0) {
            $parent = Cate::select('list_parents')->whereId($request->parent_id)->first();
            if(strpos($parent->list_parents, $request->id) == true) {
                return false;
            }
            $cate->list_parents = $parent->list_parents . $request->id . ',';

        } else {
            $cate->list_parents = ",$request->id,";
        }

        return $cate->save();
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
                Cate::where('id', $id)->update($row);
                $record_change_success++;
            }
        }
        return $record_change_success;
    }

    public function resizeImages($request, $fileName) {
        $method = [
            ['method' => 'fit','width' => '300','height' => '200'],
            ['method' => 'resize','width' => '400','height' => '400'],
            ['method' => 'crop','width' => '300','height' => '200'],
        ];

        $moduleName = 'cate';
        $pathGet = $moduleName.'/'.date('Y/m').'/original';
        $pathSet = $moduleName.'/'.date('Y/m');
        $watermark = [
            'image' => 'images/logo.png',
            'position' => 'center'
        ];
        $imageQuality = 100;

        //$image = $request->file('image');
        //$nameOldImg = substr($request->getClientOriginalName(), 0, strlen($request->getClientOriginalName()) - 4);
        $newNameImg = $fileName.'-'.time().'.'.$request->getClientOriginalExtension();
        $destDir = public_path('images/');
        $arr_folder = explode ( '/', $pathGet );
        foreach ($arr_folder as $item) {
            $destDir.= $item;
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir);
            }
            $destDir.='/';
        }

        $path = $request->move($destDir, $newNameImg);

        $images = new Images($method, $moduleName, $newNameImg, $pathGet, $pathSet, $watermark, $imageQuality);
        $images->resize();
        return $path;
    }
}
