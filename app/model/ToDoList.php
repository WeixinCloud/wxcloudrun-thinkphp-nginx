<?php

namespace app\model;

use think\Model;


class ToDoList extends Model
{
    protected $table = 'todo_list';
    public $id;
    public $title;
    public $status;
    public $create_time;
    public $update_time;
}