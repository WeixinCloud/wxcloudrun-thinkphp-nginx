<?php
// +----------------------------------------------------------------------
// | 文件: index.php
// +----------------------------------------------------------------------
// | 功能: mysql数据库表model
// +----------------------------------------------------------------------
// | 时间: 2021-11-15 16:20
// +----------------------------------------------------------------------
// | 作者: rangangwei<gangweiran@tencent.com>
// +----------------------------------------------------------------------

namespace app\model;

use think\Model;

// ToDoList 定义数据库model
class ToDoList extends Model
{
    protected $table = 'todo_list';
    public $id;
    public $title;
    public $status;
    public $create_time;
    public $update_time;
}