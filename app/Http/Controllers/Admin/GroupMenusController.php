<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Toolbar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupMenuCreateRequest;
use App\Http\Requests\GroupMenuUpdateRequest;
use App\Contracts\Repositories\GroupMenuRepository;
use App\Validators\GroupMenuValidator;


class GroupMenusController extends Controller
{

    /**
     * @var GroupMenuRepository
     */
    protected $repository;

    /**
     * @var GroupMenuValidator
     */
    protected $validator;

    public function __construct(GroupMenuRepository $repository, GroupMenuValidator $validator)
    {
        $this->toolBar = new ToolBar();
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function create() {
        return view('groupMenus.create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Menu group';
        $button = $this->toolBar->showButton('List');
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $groupMenus = $this->repository->paginate(10);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $groupMenus,
            ]);
        }

        return view('groupMenus.index', ['title' => $title, 'button' => $button, 'groupMenus' => $groupMenus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupMenuCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupMenuCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $groupMenu = $this->repository->store($request->all());

            $response = [
                'message' => 'GroupMenu created.',
                'data'    => $groupMenu->toArray(),
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
        $groupMenu = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $groupMenu,
            ]);
        }

        return view('groupMenus.show', compact('groupMenu'));
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

        $groupMenu = $this->repository->find($id);

        return view('groupMenus.edit', compact('groupMenu'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GroupMenuUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GroupMenuUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $groupMenu = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'GroupMenu updated.',
                'data'    => $groupMenu->toArray(),
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
                'message' => 'GroupMenu deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'GroupMenu deleted.');
    }


    /*i custom*/
    public function listData() {
        $button = $this->toolBar->showButton('List'); /*tham số truyền vào 2 giá trị là "List" và "Detail" tương ứng với 2 function*/
        $title = 'Menu Group';
        $list = $this->repository->paginate(10);
        return view('admin.menu.groupMenus.list', ['title' => $title, 'button' => $button, 'list' => $list]);
    }

    public function detail() {
        $button = $this->toolBar->showButton('Detail');
        $title = 'Menu Group';
        return view('admin.menu.groupMenus.detail', ['title' => $title, 'button' => $button]);
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
        return view('admin.menu.groupMenus.detail', ['title' => $title, 'button' => $button, 'data' => $data]);
    }

    public function saveNotAlias($request) {
        $this->validate($request,
            [
                'name' => 'bail|required|unique:group_menus,name'
            ],
            [
                'name.required' => 'Please enter group name',
                'name.unique' => 'The name group is exist'
            ]
        );
        return $this->repository->saveNotAlias($request);
    }

    /*function update cat*/
    public function updateCate($request, $id) {
        $this->validate($request,
            [
                'name' => 'required' /*con check trường hợp không được trùng nữa*/
            ],
            [
                'name.required' => 'Please enter group name'

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

        $moduleName = 'menuGroup';
        return $this->repository->resizeImages($request, $fileName, $moduleName, $method);
    }



    public function task(Request $request) {
        $task = $request->task;
        $id = $request->id;
        if(!$id) {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $this->saveNotAlias($request);
                    return redirect()->route('admin.menuGroup.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Group Menu']);

                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $id = $this->saveNotAlias($request);
                    return redirect()->route('admin.menuGroup.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Group Menu']);

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $this->saveNotAlias($request);
                    return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Group Menu']);

                case 'add': /*chuyển đến trang thêm chi tiết*/
                    return redirect()->route('admin.menuGroup.getAddCate');

                case 'save_all': /*chuyển đến trang thêm chi tiết*/
                    $id = $this->save_all($request);
                    if($id) {
                        return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Add Group Menu']);
                    } else {
                        return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Not Save']);
                    }

                case 'back': /*trở về trang danh sách*/
                    return redirect()->route('admin.menuGroup.listData');

                default:
                    return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);

            }
        } else {
            switch ($task) {
                case 'save-add': /*lưu thành công hay không thì cũng đưa về trang thêm vào hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.menuGroup.getAddCate')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Category']);
                    }else {
                        return redirect()->route('admin.menuGroup.getAddCate')->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }


                case 'apply': /*nếu lưu thành công thì đưa về trang sửa không thì đưa về trang thêm và hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.menuGroup.getEditCate', ['id' => $id])->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Group Menu']);
                    }else {
                        return redirect()->route('admin.menuGroup.getEditCate', ['id' => $id])->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }

                case 'save': /*lưu thành công hay không cũng đưa về trang danh sách và hiển thị thông báo*/
                    $result = $this->updateCate($request, $id);
                    if($result) {
                        return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Edit Group Menu']);
                    }else {
                        return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Can not update']);
                    }

                case 'edit': /*chuyển đến trang sửa*/ /*chỉ sử dụng khi click vào checkbox rồi click button sửa*/
                    $id = $id[0];
                    return redirect()->route('admin.menuGroup.getEditCate', ['id' => $id]);

                case 'remove': /*delete data*/
                    $result = $this->remove($id);
                    if($result) {
                        return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'success', 'flash_message' => 'Delete success']);
                    } else {
                        return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'danger', 'flash_message' => 'Exist error where delete']);
                    }

                case 'back': /*trở về trang danh sách*/
                    return redirect()->route('admin.menuGroup.listData');

                default:
                    return redirect()->route('admin.menuGroup.listData')->with(['flash_level' => 'danger', 'flash_message' => 'The action you require incorect']);

            }
        }
    }
}
