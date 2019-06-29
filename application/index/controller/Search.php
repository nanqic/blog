<?php
namespace app\index\controller;
use app\index\controller\Base;

class Search extends Base
{
   public function index()
   {
      $keywords = input('keywords');
      // dump($keywords);die;
      if ($keywords) {
         $map['title'] = ['like','%'.$keywords.'%'];
         $list = db('article')->where($map)->order('id desc')->paginate(5);
         $this->assign([
            'list' => $list,
            'keywords' => $keywords,
         ]);
      } else {
         $this->assign([
            'list' => null,
            'keywords' => '暂无结果',
         ]);
      }
      return $this->fetch('search');
   }
}