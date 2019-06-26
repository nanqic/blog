<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Article as ArticleModel;

class Article extends Base
{
    public function lst()
    {
        $list = ArticleModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }

    public function add()
    {
        $cates = db('cate')->select();
        $this->assign('cates',$cates);
        if (request()->isPost()) {
            $data = [
                'title' => input('title'),
                'author' => input('author'),
                'dsc' => input('dsc'),
                'keywords' => input('keywords'),
                'content' => input('content'),
                'cate' => input('cateid'),
            ];
            if (input('state')=='on') {
                $data['state'] = 1;
            }
            if ($_FILES['pic']['tmp_name']) {
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic'] = 'static/uploads/'.$info->getSaveName();
            }
            $validate = \think\Loader::validate('article');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            if (db('article')->insert($data)) {
                return $this->success('添加文章成功!','lst');
            } else {
                return $this->error('添加文章失败!');
            }
            return;
        }
        return $this->fetch('add');
    }

    public function del()
    {
        $res = db('article')->delete(input('id'));
       if ($res) {
           $this->success('删除文章成功!','lst');
       } else {
            $this->error('删除文章失败!');
       }
    }

    public function edit()
    {
        $id = input('id');
        $article = db('article')->find($id);
        $cates = db('cate')->select();
        $this->assign('cates', $cates);
        $this->assign('article',$article);

        if (request()->isPost()) {
            $data = [
                'author' => input('author'),
                'title' => input('title'),
                'keywords' => input('keywords'),
                'dsc' => input('dsc'),
                'content' => input('content'),
                'cate' => input('cate'),
            ];
            // dump($data);die;
            if (input('state')=='on') {
                $data['state'] = 1;
            } else {
                $data['state'] = 0;
            }
            if ($_FILES['pic']['tmp_name']) {
                // 删除原图片
                @unlink(SITE_URL.'/public/static'.$article['pic']);
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic'] = 'static/uploads/'.$info->getSaveName();
            }
            $validate = \think\Loader::validate('article');
            if (!$validate->check($data)) {
                $this->error($validate->getError()); die;
            }
            $update = db('article')->where('id',$article['id'])->update($data);
            if ($update) {
                $this->success('修改成功!','lst');
            } else {
                $this->error('修改失败!');
            }
        }
        return $this->fetch('edit');
    }
}