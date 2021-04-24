<?php


namespace controller;
use model\Model;
use framework\Page;

session_start();
class IndexController extends Controller
{
	function index()
	{
		$page = $_GET['page'];
		if (empty($page)){
			$pageNum = 0;
		} else {
			$pageNum = ($page-1)*5;
		}
		
		$config = include 'db_config.php';
		$m = new Model($config);
		$idRes = $m->field('id,isremove')->table('article')->where('isremove!=1')->select();
		$num = $idRes[1];
		$res = $m->field('id,title,overview,wrtime,uid')->table('article')->order('wrtime desc')->where('isremove!=1')->limit("$pageNum,5")->select();
		$atcnum = $res[1];
		$s = $res[0];
		for ($i = 0; $i < $num; $i++) {
			$id[$i] = $s[$i]['id'];
			$uid = $s[$i]['uid'];
			$userInfo = $m->field('id,username')->where("id=$uid")->table('user')->select();
			$username[$i] = $userInfo[0][0]['username'];
			$title[$i] = $s[$i]['title'];
			$overview[$i] = $s[$i]['overview'];
			$wrtime[$i] = substr($s[$i]['wrtime'], 0,10);
		}
		// 分页部分
		/* 尝试重写函数
		function prev()
		{
			if (empty($page) || $page=1){
				return 'nanhj.me';
			} else {
				$page--;
				return 'page='.$page;
			}
		}
		function next($num,$page)
		{
			$totalPage = $num / 5;
			if ($page > $totalPage){
				return '?page='.$page;
			} else {
				$page++;
				return '?page='.$page;
			}
		}*/
		$p = new Page(5,$num);
		$first = $p->first();
		$this->assign('first', $first);
		$prev = $p->prev();
		$this->assign('prev', $prev);

		$next = $p->next();
		$this->assign('next', $next);
		$end = $p->end();
		$this->assign('end', $end);

		$this->assign("id", $id);
		$this->assign("atcnum", $atcnum);
		$this->assign("title", $title);
		$this->assign('username', $username);
		$this->assign('overview', $overview);
		$this->assign('wrtime', $wrtime);
		$this->assign('user', $_SESSION['username']);
		$this->display('index.html');
	}
	function logout()
	{
		$_SESSION['isLogin'] = '';
		header('Location:index.php');
	}
}
