<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;

class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $admin = new Admin();
            $data = input('post.');
            switch ($admin->login($data)) 
            {
                case 1: 
                    return $this->error("管理员不存在!");
                    break;
                case 2:
                    return $this->error("账号或密码错误");
                    break;
                case 3:
                    return $this->success("登录成功!",'index/index');
                    break;
                case 4:
                    return $this->error('验证码错误!');
            }
        }
        return $this->fetch('login');
    }
}