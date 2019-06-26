<?php
namespace app\admin\validate;
use think\Validate;

class Links extends Validate
{
    // 验证规则
    protected $rule = [
        'url' => 'require|max:60',
        'title' => 'require',
    ];

    // 提示信息
    protected $message = [
        'url.require' => '链接地址必须填写',
        'url.max' => '链接地址不能大于60位',
        'title.require' => '标题不能为空',
    ];
}