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

// 查询用户
Route::get('user/:id', 'index/queryUserById');

// 新增用户
Route::post('user', 'index/addUser');

// 删除用户
Route::delete('user/:id', 'index/deleteUserById');

// 修改用户
Route::put('user', 'index/updateUserById');
