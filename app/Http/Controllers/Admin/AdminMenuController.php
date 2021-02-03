<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminMenuService;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    protected $adminMenu;

    public function __construct(AdminMenuService $adminMenu)
    {
        $this->adminMenu = $adminMenu;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function index()
    {
        $list = $this->adminMenu->getList([]);

        return response_json($list);
    }

    /**
     * 添加数据
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function store(Request $request)
    {
        $param = verify('POST', [
            'name' => 'required',
            'description' => '',
            'url' => '',
            //'icon' => 'no_required',
            'level' => 'int|required',
            'parent_id' => 'int|required',
            'is_auth' => 'int',
            'order' => 'int'
        ]);

        $this->adminMenu->add($param);

        return response_json();
    }

    /**
     * 显示单项
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function show($id)
    {
        $this->adminMenu->getOne($id);

        return response_json();
    }

    /**
     * 更新
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function update(Request $request, $id)
    {
        $param = verify('POST', [
            'name' => '',
            'description' => '',
            'url' => '',
            //'icon' => 'no_required',
            'parent_id' => 'int',
            'order' => 'int',
            'menu_group_id' => 'int',
        ]);

        $this->adminMenu->edit($param, $id);

        return $this->response();
    }

    /**
     * 删除
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function destroy($id)
    {
        $this->verifyId($id);

        $this->adminMenu->delete($id);

        return $this->response();
    }
}
