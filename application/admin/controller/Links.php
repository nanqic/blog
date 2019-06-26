<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Links as LinksModel;

class Links extends Base
{
    public function lst()
    {
        $list = linksModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'title' => input('title'),
                'url' => input('url'),
                'dsc' => input('dsc'),
            ];
            $validate = \think\Loader::validate('links');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (db('links')->insert($data)) {
                return $this->success('添加链接成功!','lst');
            } else {
                return $this->error('添加链接失败!');
            }
            return;
        }
        return $this->fetch('add');
    }

    public function del()
    {
        // $id = input('id');
        $res = db('links')->delete(input('id'));
       if ($res) {
           $this->success('删除链接成功!','lst');
       } else {
            $this->error('删除链接失败!');
       }
    }

    public function edit()
    {
        $id = input('id');
        $links = db('links')->find($id);
        $this->assign('links',$links);

        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'url' => input('url'),
                'dsc' => input('dsc'),
            ];
            $validate = \think\Loader::validate('links');
            if (!$validate->check($data)) {
                $this->error($validate->getError()); die;
            }
            $update = db('links')->update($data);
            if ($update) {
                $this->success('修改成功!','lst');
            } else {
                $this->error('修改失败!');
            }
        }
        return $this->fetch('edit');
    }
}