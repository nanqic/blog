<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
    // 验证规则
    protected $rule = [
        'author' => 'require|max:20',
        'title' => 'require|max:60',
    ];

    // 提示信息
    protected $message = [
        'author.require' => '作者名字必须填写',
        'author.max' => '作者名字不能超过30个字符',
        'title.max' => '文章标题不能超过60个字符',
        'title.require' => '标题不能为空',
    ];
}