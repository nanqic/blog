<?php


namespace controller;
use \model\Model;
session_start();

class SigninController extends Controller
{
	function index()
	{
		$this->display('signin.html');
	}
	function login()
	{
		if ($_POST) {
			extract($_POST);
			$password = md5($password);
			// var_dump($keep); //on
			if (strlen($username) == '' || strlen($password) == '') {
				header('Refresh:2;url=index.php?m=signin');
				die('用户名或密码不能为空');
			}
			$config = include 'db_config.php';
			$m = new Model($config);
			$res = $m->field('id,username,password')->where("username='$username'&&password='$password'")->table('user')->select();
			if ($res[1]) {
				$_SESSION['isLogin'] = '1';
				$_SESSION['uid'] = $res[0][0]['id'];
				$_SESSION['username'] = "$username";
				unset($_SESSION['vcode']);

				header('Location:index.php');
			} else {
				header('Refresh:2;url=index.php?m=signin');
				exit('用户名或密码不正确');
			}
		}
	}

}
