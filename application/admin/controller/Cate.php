<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Cate as CateModel;

class Cate extends Base
{
    public function lst()
    {
        $list = CateModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'catename' => input('catename'),
            ];
            $validate = \think\Loader::validate('cate');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (db('cate')->insert($data)) {
                return $this->success('添加栏目成功!','lst');
            } else {
                return $this->error('添加栏目失败!');
            }
            return;
        }
        return $this->fetch('add');
    }

    public function del()
    {
        $res = db('cate')->delete(input('id'));
       if ($res) {
           $this->success('删除栏目成功!','lst');
       } else {
            $this->error('删除栏目失败!');
       }
    }

    public function edit()
    {
        $id = input('id');
        $cate = db('cate')->find($id);
        $this->assign('cate',$cate);

        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'catename' => input('catename'),
            ];
            $validate = \think\Loader::validate('cate');
            if (!$validate->check($data)) {
                $this->error($validate->getError()); die;
            }
            $update = db('cate')->update($data);
            if ($update) {
                $this->success('修改成功!','lst');
            } else {
                $this->error('修改失败!');
            }
        }
        return $this->fetch('edit');
    }
}