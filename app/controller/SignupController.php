<?php

namespace controller;
use \model\Model;
session_start();

class SignupController extends Controller
{
	
	function index()
	{
		$this->display('signup.html');
	}

	function add()
	{	
		if ($_POST){
			// 解析POST传来的变量
			extract($_POST);
			// 导入数据库配置文件
			$vcode = strtolower($vcode);
			$vcodeInfo = $_SESSION['vcode'];
			function checkEmail($email)
			{
				if (strpos($email, '@') != false){
					if (strlen($email) > 32 || strlen($email) < 5){
						return false;
					}else{
						return true;
					}
				} else if (strlen($email) != 11) {
					return false;
				} else {
					return true;
				}
			}
			if ($vcode != $vcodeInfo) {
				header('Refresh:2;url=index.php?m=signup');
				die('验证码不正确');
			} else if (strlen($username ) < 3 || strlen($username) > 12) {

				header('Refresh:2;url=index.php?m=signup');
				die('用户名只能为4-12个字符');
			} else if (strlen($password) < 6 || strlen($password) > 16) {
				header('Refresh:2;url=index.php?m=signup');
				die('密码的长度为6-16个字符');				
			} else if ($checkEmail) {
				header('Refresh:2;url=index.php?m=signup');
				die('手机号或邮箱格式不正确');
			}
			$config = include 'db_config.php';
			$m = new Model($config);

			// 查询数据库是否已经注册过
			$nameRes = $m->field('username')->table('user')->where("username='$username'")->select();
			$emailRes = $m->field('email')->table('user')->where("email='$email'")->select();
			if ($nameRes[1] >0) {
				echo "用户名已经被使用";
				header('Refresh:2;url=index.php?m=signup');
			} else if ($emailRes[1] > 0){
				echo "手机号或邮箱已经注册过";
				header('Refresh:2;url=index.php?m=signup');
			}else{
				$data = ['username' => $username, 'password' => md5($password), 'email' => $email];
				$insertId = $m->table('user')->insert($data);
				if ($insertId > 0){
					echo "注册成功!";
					$_SESSION['isLogin'] = '1';
					$_SESSION['username'] = $username;
					header('Refresh:2;url=index.php');
				}
			}
		}
	}
}
