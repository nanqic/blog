<?php
namespace app\admin\controller;
use app\admin\controller\Base;

class Tags extends Base
{
    public function lst()
    {
        $list = db('tags')->paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'tagname' => input('tagname'),
            ];
            $validate = \think\Loader::validate('tags');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (db('tags')->insert($data)) {
                return $this->success('添加标签成功!','lst');
            } else {
                return $this->error('添加标签失败!');
            }
            return;
        }
        return $this->fetch('add');
    }

    public function del()
    {
        $res = db('tags')->delete(input('id'));
       if ($res) {
           $this->success('删除标签成功!','lst');
       } else {
            $this->error('删除标签失败!');
       }
    }

    public function edit()
    {
        $id = input('id');
        $tags = db('tags')->find($id);
        $this->assign('tags',$tags);

        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'tagname' => input('tagname'),
            ];
            $validate = \think\Loader::validate('tags');
            if (!$validate->check($data)) {
                $this->error($validate->getError()); die;
            }
            $update = db('tags')->update($data);
            if ($update) {
                $this->success('修改成功!','lst');
            } else {
                $this->error('修改失败!');
            }
        }
        return $this->fetch('edit');
    }
}