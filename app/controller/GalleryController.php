<?php


namespace controller;
use \model\Model;
session_start();
class GalleryController extends Controller
{
	function index()
	{
		$config = include 'db_config.php';
		$m = new Model($config);
		$res = $m->field('imagepath')->table('gallery')->select();
		$imgCount = $res[1];
		for ($i = 0; $i < $imgCount; $i++) {
			$imagepath[$i] = $res[0][$i]['imagepath'];
		}
		$this->assign('user', $_SESSION['username']);
		$this->assign('imgCount', $imgCount);
		$this->assign('imagepath', $imagepath);
		$this->display('gallery.html');
	}
}
