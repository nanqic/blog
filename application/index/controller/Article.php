<?php
namespace app\index\controller;
use app\index\controller\Base;

class Article extends Base
{
    public function index()
    {
        $id = input('id');
        db('article')->where('id','=',$id)->setInc('click');
        $article = db('article')->where('id',$id)->find();
        $cateid = $article['cate'];
        $catename = db('cate')->where('id',$cateid)->find();
        $this->assign([
            'article' => $article,
            'catename' => $catename,
            ]);
        return $this->fetch('article');
    }
}