<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        // 执行点击和推荐
        $this->right();
        $cates = db('cate')->order('id desc')->select();
        $links = db('links')->select();
        $this->assign([
            'cates' => $cates,
            'links' => $links,
        ]);
    }
    // 点击和推荐
    public function right()
    {
        $click = db('article')->order( 'click desc')->field('id,title,keywords')->limit(6)->select();
        $recom = db('article')->where('state','=',1)->field('id,title')->order('click desc')->limit(6)->select();
        $this->assign( [
                "click" => $click,
                "recom" => $recom,
            ]);
    }
}