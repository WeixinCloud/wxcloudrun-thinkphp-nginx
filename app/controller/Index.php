<?php
// +----------------------------------------------------------------------
// | 文件: index.php
// +----------------------------------------------------------------------
// | 功能: 提供todo api接口
// +----------------------------------------------------------------------
// | 时间: 2021-11-15 16:20
// +----------------------------------------------------------------------
// | 作者: rangangwei<gangweiran@tencent.com>
// +----------------------------------------------------------------------

namespace app\controller;

use Error;
use Exception;
use think\Request;
use app\model\ToDoList;
use think\response\Html;
use think\response\Json;

class Index
{

    /**
     * 主页静态页面
     * @return Html
     */
    public function index(): Html
    {
        # html路径: ../view/index.html
        return response(file_get_contents(dirname(dirname(__FILE__)).'/view/index.html'));
    }


    /**
     * 获取todo list
     * @return Json
     */
    public function getToDoList(): Json
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
     * 根据id查询todo数据
     * @param $id
     * @return Json
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
            $todo = $toDoList->create(["title" => $request->param("title"), "status" => $request->param("status"),]);
            $res = [
                "code" => 0,
                "data" => $todo,
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
     * 根据id删除todo
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
     * 根据id更新todo数据
     * @param Request $request
     * @return Json
     */
    public function updateToDo(Request $request): Json
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
