<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Base;

class Admin extends Base
{
    public function __initialize()
    {
        if (!session('username')) {
            $this->error('请先登录系统!','Login/index');
        }
    }
    public function lst()
    {
        $list = AdminModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'username' => input('username'),
                'password' => md5(input('password')),
            ];
            $validate = \think\Loader::validate('Admin');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (db('admin')->insert($data)) {
                return $this->success('添加管理员成功!','lst');
            } else {
                return $this->error('添加管理员失败!');
            }
            return;
        }
        return $this->fetch('add');
    }

    public function del()
    {
        $res = db('links')->delete(input('id'));
       if ($res) {
           $this->success('删除管理员成功!','lst');
       } else {
            $this->error('删除管理员失败!');
       }
    }

    public function edit()
    {
        $id = input('id');
        $admin = db('admin')->find($id);
        $this->assign('admin',$admin);

        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'username' => input('username'),
            ];
            if (input('password')) {
                $data['password'] = md5(input('password'));
            } else {
                $data['password'] = $admin['password'];
            }
            $validate = \think\Loader::validate('Admin');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError()); die;
            }
            $update = db('admin')->update($data);
            if ($update) {
                $this->success('修改成功!','lst');
            } else {
                $this->error('修改失败!');
            }
        }
        return $this->fetch('edit');
    }

    public function logout()
    {
        session(null);
        $this->success('退出成功!','login/index');
    }
}