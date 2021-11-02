<?php

namespace app\controller;

use app\BaseController;
use Exception;
use think\Request;
use app\model\User;
use think\response\Json;

class Index extends BaseController
{
    /**
     * 根据主键ID查询用户数据
     *
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\DataNotFoundException
     */
    public function queryUserById($id): Json
    {
        try {
            $user = (new User)->find($id);
            $res = [
                "code" => 0,
                "data" => ($user->getData()),
                "message" => ""
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "message" => ("查询用户异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 增加用户
     * @param Request $request
     * @return Json
     */
    public function addUser(Request $request): Json
    {
        try {
            $user = new User;
            $user->save([
                "name" => $request->param("name"),
                "email" => $request->param("email"),
                "phone" => $request->param("phone"),
                "description" => $request->param("description"),
            ]);
            $res = [
                "code" => 0,
                "data" => [],
                "message" => "插入成功"
            ];
            return json($res);

        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "message" => ("新增用户异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 根据ID删除用户
     * @param $id
     * @return Json
     */
    public function deleteUserById($id): Json
    {
        try {
            User::destroy($id);
            $res = [
                "code" => 0,
                "data" => [],
                "message" => "删除用户成功"
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "message" => ("删除用户异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 根据ID更新用户数据
     * @param Request $request
     */
    public function updateUserById(Request $request)
    {
        try {
            User::update([
                'name' => $request->param("name"),
                'email' => $request->param('email'),
                'phone' => $request->param('phone'),
                'description' => $request->param('description')
            ],
                ['id' => $request->param('id')]
            );

            $res = [
                "code" => 0,
                "data" => [],
                "message" => ""
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "message" => ("更新用户异常" . $e->getMessage())
            ];
            return json($res);
        }
    }
}
