<?php


namespace controller;
use model\Model;
session_start();
class ArtailController extends Controller
{
	function index()
	{
		if ($_GET) {
			$pid = $_GET['id'];
			$config = include 'db_config.php';
			$m = new Model($config);
			$res = $m->field('id,title,overview,textpath, uid, wrtime')->table('article')->where("id = $pid")->select();
			$id = $res[0][0]['id'];
			$title = $res[0][0]['title'];
			$overview = $res[0][0]['overview'];
			$textpath = $res[0][0]['textpath'];
			$uid = $res[0][0]['uid'];
			$wrtime = $res[0][0]['wrtime'];
			if (!empty($textpath)){
				$file = fopen($textpath, 'r');
				$text = file_get_contents($textpath);
				fclose($file);
			} else {
				$text = $overview;
			}
			$userInfo = $m->field('username')->table('user')->where("id=$uid")->select();
			$author = $userInfo[0][0]['username'];

			// 读取评论列表
			$commRes = $m->table('comment,user')->field('content,uid,username,wrtime')->where("comment.uid=user.id&&comment.pid=$pid")->select();
			$commnum = $commRes[1];
			for ($i = 0; $i < $commnum; $i++) { 
				$content[$i] = $commRes[0][$i]['content'];
				$commuser[$i] = $commRes[0][$i]['username'];
				$commtime[$i] = substr($commRes[0][$i]['wrtime'], 0, 10);
			}
			$this->assign('id',$id);
			$this->assign('pid',$pid);
			$this->assign('title',$title);
			$this->assign('text',$text);
			$this->assign('author',$author);
			$this->assign('wrtime',$wrtime);
			$this->assign('user', $_SESSION['username']);
			$this->assign('content',$content);
			$this->assign('commuser',$commuser);
			$this->assign('commtime',$commtime);
			$this->assign('commnum',$commnum);
			$this->display('artail.html');
		}
	}

	function edit()
	{
		$config = include 'db_config.php';
		$m = new Model($config);
		if ($_GET){
			$id = $_GET['id'];
			// 多表联合查询得到作者信息
			$authRes = $m->table('user,article')->field('username,title,textpath')->where("user.id=article.uid&&article.id=$id")->select();
			$author = $authRes[0][0]['username'];
			$title = $authRes[0][0]['title'];
			$textpath = $authRes[0][0]['textpath'];
			$overview = $authRes[0][0]['overview'];
			// 判断是否有修改权限
			if ($author == $_SESSION['username']){
				$data = ['isremove' => 1];
				$res = $m->table('article')->where("id=$id")->update($data);
			} else {
				header('Refresh:2;url=index.php');
				die("没有修改权限!");
			}
			if (!empty($textpath)){
				$file = fopen($textpath, 'r');
				$text = file_get_contents($textpath);
				fclose($file);
			} else {
				$text = $overview;
			}
			$this->assign('title',$title);
			$this->assign('text',$text);
			$this->display('addatc.html');
		}

	}

	function del()
	{
		$config = include 'db_config.php';
		$m = new Model($config);
		if ($_GET){
			$id = $_GET['id'];
			$data = ['isremove' => 1];
			$authRes = $m->table('user,article')->field('username')->where("user.id=article.uid&&article.id=$id")->select();
			$author = $authRes[0][0]['username'];
			if ($author == $_SESSION['username']){
				$res = $m->table('article')->where("id=$id")->update($data);
				// $res = $m->table('article')->where("id=$id")->delete();
			} else {
				echo "没有删除权限!";
				header('Refresh:2;url=index.php');
			}
			if ($res) {
				echo '删除成功!';
				header('Refresh:2;url=index.php');
			}
		}

	}
	function comment()
	{
		$config = include 'db_config.php';
		$m = new Model($config);
		if ($_POST){
			extract($_POST);
			$uid = $_SESSION['uid'];
			var_dump($_POST);
			$data = [
				'content' => "$content",
				'uid' => "$uid",
				'pid' => "$pid",
			];
			$res = $m->table('comment')->insert($data);
			if ($res) {
				echo "<script>alert('评论发表成功!!');history.back();</script>";
			}
		}
	}
}
