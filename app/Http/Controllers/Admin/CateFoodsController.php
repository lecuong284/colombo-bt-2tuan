<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toolbar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CateFoodCreateRequest;
use App\Http\Requests\CateFoodUpdateRequest;
use App\Contracts\Repositories\CateFoodRepository;
use App\Validators\CateFoodValidator;


class CateFoodsController extends Controller
{

    /**
     * @var CateFoodRepository
     */
    protected $repository;

    /**
     * @var CateFoodValidator
     */
    protected $validator;

    public function __construct(CateFoodRepository $repository, CateFoodValidator $validator)
    {
        $this->toolBar = new ToolBar();
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cateFoods = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cateFoods,
            ]);
        }

        return view('cateFoods.index', compact('cateFoods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CateFoodCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CateFoodCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cateFood = $this->repository->create($request->all());

            $response = [
                'message' => 'CateFood created.',
                'data'    => $cateFood->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cateFood = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cateFood,
            ]);
        }

        return view('cateFoods.show', compact('cateFood'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cateFood = $this->repository->find($id);

        return view('cateFoods.edit', compact('cateFood'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CateFoodUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CateFoodUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cateFood = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CateFood updated.',
                'data'    => $cateFood->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'CateFood deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CateFood deleted.');
    }


    /*i custom*/
    public function listData() {
        $button = $this->toolBar->showButton('List'); /*tham số truyền vào 2 giá trị là "List" và "Detail" tương ứng với 2 function*/
        $title = 'Category Food';
        $list = $this->repository->paginate(10);
        return view('admin.food.cateFood.list', ['title' => $title, 'button' => $button, 'list' => $list]);
    }

    public function detail() {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Add Categories Food';
        return view('admin.food.cateFood.detail', ['title' => $title, 'button' => $button]);
    }

    /*public function editCate($id) {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Category edit';
        $data = $this->repository->editCate($id);
        return view('admin.menu.groupMenus.detail', ['title' => $title, 'button' => $button, 'data' => $data[0], 'cates' => $data[1]]);
    }*/

    public function editR($id) {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Category edit';
        $data = $this->repository->editR($id);
        return view('admin.food.cateFood.detail', ['title' => $title, 'button' => $button, 'data' => $data]);
    }

    public function save($request) {
        $this->validate($request,
            [
                'name' => 'bail|required|unique:menus,name'
            ],
            [
                'name.required' => 'Please enter item name',
                'name.unique' => 'The name item is exist'
            ]
        );
        return $this->repository->save($request);
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

        return $this->repository->update($request->All(), $id);
    }

    public function save_all($request) {
        return $this->repository->save_all($request);
    }

    public function remove($id) {
        return $this->repository->destroy($id);
    }

    public function resizeImages($request, $fileName) {
        $method = [
            ['method' => 'fit','width' => '300','height' => '200'],
            ['method' => 'resize','width' => '400','height' => '400'],
            ['method' => 'crop','width' => '300','height' => '200'],
        ];

        $moduleName = 'cateFood';
        return $this->repository->resizeImages($request, $fileName, $moduleName, $method);
    }



    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        if(!$id) {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $this->save($request);
                    return redirect()->route('admin.cateFood.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Cate Food']);

                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $id = $this->save($request);
                    return redirect()->route('admin.cateFood.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Cate food']);

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $this->save($request);
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
