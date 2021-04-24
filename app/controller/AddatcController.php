<?php


namespace controller;
use \model\Model;
session_start();
class AddatcController extends Controller
{
	function index()
	{
		$this->assign('username', $_SESSION['username']);
		$this->display('addatc.html');
	}
	function add()
	{
		if ($_POST) {

			$config = include 'db_config.php';
			$m = new Model($config);
			$username = $_SESSION['username'];
			$res = $m->field('username,id')->where("username='$username'")->table('user')->select();
			$uid = $res[0][0]['id'];

			extract($_POST);
			if ($title == null) {
				header('Refresh:2;url=index.php?m=addatc');
				die('文章标题不能为空');
			}
			if (strlen($title) > 140) {
				header('Refresh:2;url=index.php?m=addatc');
				die('标题字数超过最大限制');
			}
			if ($text == null) {
				header('Refresh:2;url=index.php?m=addatc');
				die('文章内容不能为空');
			}
			$textpath = '';
			if (strlen($text) > 256){
				$textpath = 'text/'.date('y-m-d',time()).'-'.uniqid().'.txt';
				$file = fopen($textpath, 'w+');
				file_put_contents($textpath, $text);
				fclose($file);
				$text = mb_substr($text, 0, 150, 'utf-8').'...';
			}
			$data = ['title' => $title, 'overview' => $text, 'textpath' => $textpath,'uid' => $uid];
			$insertId = $m->table('article')->insert($data);
			if ($insertId) {
				header('Refresh:2;url=index.php');
				echo "操作成功!";
			} else {
				echo "操作失败";
				unlink($textpath);

			}
		}
	}
}
