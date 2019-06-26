<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
    // 验证规则
    protected $rule = [
        'catename' => 'require|max:25|unique:cate',
    ];

    // 提示信息
    protected $message = [
        'catename.require' => '栏目名称必须填写',
        'catename.max' => '栏目名称不能大于25位',
        'catename.unique' => '栏目已存在!',
    ];
}