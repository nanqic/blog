<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    // 验证规则
    protected $rule = [
        'username' => 'require|min:4|max:25|unique:admin',
        'password' => 'require',
    ];

    // 提示信息
    protected $message = [
        'username.require' => '管理员名称必须填写',
        'username.unique' => '管理员名称已经存在',
        'username.min' => '管理员名称不能小于4位',
        'username.max' => '管理员名称不能大于25位',
        'password.require' => '管理员密码不能为空',
    ];

    // 应用场景
    protected $scene = [
        'edit' => ['password'], // 不再验证用户名
    ];
}