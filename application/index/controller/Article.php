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
        $xgread = $this->relate($article['keywords'],$article['id']);
        // dump($xgread);die;
        $this->assign([
            'article' => $article,
            'catename' => $catename,
            'xgread' => $xgread,
            ]);
        return $this->fetch('article');
    }

    public function relate($keywords,$id) {
        $arr = explode(',', $keywords);
        static $relateres = [];
        foreach ($arr as $k=>$v) {
            $map['keywords'] =['like','%'.$v.'%'];
            $map['id'] =['neq',$id];
            $relateres = db('article')->where($map)->order('id desc')->limit(6)->select();
        }

        return $relateres;
    }
}