<?php
namespace app\admin\validate;
use think\Validate;

class Tags extends Validate
{
    // 验证规则
    protected $rule = [
        'tagname' => 'require|max:20',
    ];

    // 提示信息
    protected $message = [
        'tagname.require' => '标签名称必须填写',
        'tagname.max' => '标签名称不能大于20位',
    ];
}