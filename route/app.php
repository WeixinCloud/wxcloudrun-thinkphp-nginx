<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

// 通过id查询todo
Route::get('api/todos/:id', 'index/queryToDoById');

// 查询todo list
Route::get('api/todos', 'index/getToDoList');

// 新增tod
Route::post('api/todos', 'index/addToDo');

// 通过id删除todo
Route::delete('api/todos/:id', 'index/deleteToDoById');

// 修改todo
Route::put('api/todos', 'index/updateToDo');
