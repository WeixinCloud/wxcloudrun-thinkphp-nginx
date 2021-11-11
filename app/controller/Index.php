<?php

namespace app\controller;

use app\BaseController;
use Error;
use Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Request;
use app\model\ToDoList;
use think\response\Json;

class Index extends BaseController
{
    /**
     * 获取todo list
     */
    public function getToDoList(Request $request): Json
    {
        try {
            $toDoList = (new ToDoList)->select();
            $res = [
                "code" => 0,
                "data" => ($toDoList),
                "errorMsg" => "查询成功"
            ];
            return json($res);
        } catch (Error $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("查询todo list异常" . $e->getMessage())
            ];
            return json($res);
        }
    }


    /**
     * 根据主键ID查询todo数据
     */
    public function queryToDoById($id): Json
    {
        try {
            $toDoList = (new ToDoList)->find($id);
            $res = [
                "code" => 0,
                "data" => ($toDoList->getData()),
                "errorMsg" => "查询成功"
            ];
            return json($res);
        } catch (Error $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("查询todo异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 增加todo
     * @param Request $request
     * @return Json
     */
    public function addToDo(Request $request): Json
    {
        try {
            $toDoList = new ToDoList;
            $toDoList->save(["title" => $request->param("title"), "status" => $request->param("status"),]);
            $res = [
                "code" => 0,
                "data" => [],
                "errorMsg" => "插入成功"
            ];
            return json($res);

        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("新增todo异常" . $e->getMessage()),
            ];
            return json($res);
        }
    }

    /**
     * 根据ID删除todo
     * @param $id
     * @return Json
     */
    public function deleteToDoById($id): Json
    {
        try {
            ToDoList::destroy($id);
            $res = [
                "code" => 0,
                "data" => [],
                "errorMsg" => "删除todo成功"
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("删除todo异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 根据ID更新todo数据
     * @param Request $request
     */
    public function updateToDo(Request $request)
    {
        try {
            $allowField = array();
            if (null != $request->param("title")) {
                $allowField[] = "title";
            }
            if (null != $request->param("status")) {
                $allowField[] = "status";
            }

            ToDoList::update(
                ["title" => $request->param("title"), "status" => $request->param("status"),],
                ['id' => $request->param('id')],
                $allowField
            );

            $res = [
                "code" => 0,
                "data" => [],
                "errorMsg" => ""
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("更新todo异常" . $e->getMessage())
            ];
            return json($res);
        }
    }
}
