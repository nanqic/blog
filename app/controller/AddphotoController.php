<?php


namespace controller;
use \model\Model;
use \framework\Upload;
use \framework\Image;
session_start();
class AddphotoController extends Controller
{
	function index()
	{
		$this->assign('username', $_SESSION['username']);
		$this->display('addphoto.html');
		
	}
	function upload()
	{
		$up = new Upload();
		$up->uploadFile('fm');
		// 将图片信息写入数据库
		$config = include 'db_config.php';
		$m = new Model($config);
		$imagepath = 'upload/'.$up->newName;
		$uid = $_SESSION['uid'];
		$data = ['imagepath' => "$imagepath", 'uid' => "$uid"];
		$insertId = $m->table('gallery')->insert($data);
		// 判断图片是否上传成功
		if ($insertId) {
			header('Refresh:2;url=index.php?m=gallery');
			echo '上传成功!';
		} else {
			header('Refresh:2;url=index.php?m=gallery');
			exit('上传失败');
		}
		$image = new Image();
		$imagepath = '/'.$imagepath;
		$image->water("$imagepath");

	}
}