<?php

namespace app\model;

use think\Model;


class User extends Model
{
    protected $table = 'user';
    public $id;
    public $name;
    public $email;
    public $phone;
    public $description;
    public $create_time;
    public $update_time;
}