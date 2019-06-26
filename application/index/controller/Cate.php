<?php
namespace app\index\controller;
use app\index\controller\Base;

class Cate extends Base
{
   public function index()
   {
      
      $cateid = input('cateid');
      $cate_name = db('cate')->where('id',$cateid)->field('catename')->find();
      $list = db('article')->where(array('cate'=>$cateid))->paginate(5);
      $catename = $cate_name['catename'];
      $this->assign('catename',$catename);
      $this->assign('list',$list);
      return $this->fetch('cate');
   }
}