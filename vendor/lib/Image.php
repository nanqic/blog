<?php

namespace framework;
class Image
{
	// 路径
	protected $path;
	// 是否启用随机名字
	protected $isRandName;
	// 要保存的图像类型
	protected $type;

	// 通过构造方法初始化成员属性
	function __construct($path = './', $isRandName = false, $type = 'png')
	{
		$this->path = $path;
		$this->isRandName = $isRandName;
		$this->type = $type;
	}

	// 对外公开的水印方法
	function water($image = '', $water = '/images/logo.png', $position = 9, $alpha = 80, $prefix = '')
	{
		
		// 1.判断两个图片是否存在
		if((!file_exists($image))||(!file_exists($water)))
		{
			exit();
			// die('图片资源不存在');
		}
		// 2.获取图片尺寸信息
		$imageInfo = self::getImageInfo($image);
		$waterInfo = self::getImageInfo($water);
		// 3.判断水印图片尺寸是否合法
		if(!$this->checkImage($imageInfo,$waterInfo))
		{
			exit('水印图片过大');
		}
		// 4.打开图片
		$imageRes = self::openAnyImage($image);
		$waterRes = self::openAnyImage($water);
		// 5.计算水印图片坐标
		$pos = $this->getPosition($position,$imageInfo,$waterInfo);
		// 6.将水印图片贴到原图片
		imagecopymerge($imageRes, $waterRes, $pos['x'], $pos['y'], 0, 0, $waterInfo[0], $waterInfo[1], $alpha);
		// 7.得到要保存图片的文件名
		$newName = $this->createNewName($image,$prefix);
		// 8.得到保存图片的路径	文件全路径
		$newPath =  rtrim($this->path,'/').'/img/'.$newName;
		// 9.保存图片
		// header('Content-Type:image/jpeg');
		$func = 'image'.$this->type;
		$func($imageRes,$newPath);
		// 10.销毁资源
		imagedestroy($imageRes);
		imagedestroy($waterRes);
	}

	// 判断水印合法函数
	protected function checkImage($imageInfo,$waterInfo)
	{
		if(($waterInfo['0'] > $imageInfo['0']) || ($waterInfo['1'] > $imageInfo['1']))
		{
			return false;
		}else{
			return true;
		}
	}

	// 计算水印图片坐标函数
	protected function getPosition($position,$imageInfo,$waterInfo)
	{
		switch ($position)
		{
			case 1:
				$x = 0;
				$y = 0;
				break;
			case 2:
				$x = ($imageInfo[0] - $waterInfo[0]) / 2;
				$y = 0;
				break;
			case 3:
				$x = $imageInfo[0] - $waterInfo[0];
				$y = 0;
				break;
			case 4:
				$x = 0;
				$y = ($imageInfo[1] - $waterInfo[1]) / 2;
				break;
			case 5:
				$x = ($imageInfo[0] - $waterInfo[0]) / 2;
				$y = ($imageInfo[1] - $waterInfo[1]) / 2;
				break;
			case 6:
				$x = $imageInfo[0] - $waterInfo[0];
				$y = ($imageInfo[1] - $waterInfo[1]) / 2;
				break;
			case 7:
				$x = 0;
				$y = $imageInfo[1] - $waterInfo[1];
				break;
			case 8:
				$x = ($imageInfo[0] - $waterInfo[0]) / 2;
				$y = $imageInfo[1] - $waterInfo[1];
				break;
			case 9:
				$x = $imageInfo[0] - $waterInfo[0];
				$y = $imageInfo[1] - $waterInfo[1];
				break;
			case 0:
				$x = mt_rand(0,($imageInfo[0] - $waterInfo[0]));
				$y = mt_rand(0,($imageInfo[1]- $waterInfo[1]));
				break;
		}
		return ['x' => $x, 'y' => $y];
	}

	// 得到文件名函数
	protected function createNewName($image,$prefix)
	{
		if($this->isRandName)
		{
			$name = $prefix.uniqid().'.'.$this->type;
		}else{
			$name = $prefix.pathinfo($image)['filename'].'.'.$this->type; 
		}
		return $name;
	}

	// 静态方法
	// 根据图片路径获取图片信息
	static function getImageInfo($imagePath)
	{
		// 得到图片信息
		$info = getimagesize($imagePath);
		return $info;
	}

	static function openAnyImage($imagePath)
	{
		// 得到图像的mime类型
		$mime = self::getImageInfo($imagePath)['mime'];
		// 根据mime类型打开图片
		switch ($mime)
		{
			case 'image/png':
				$image =imagecreatefrompng($imagePath);
				break;
			case 'image/gif':
				$image =imagecreatefromgif($imagePath);
				break;
			case 'image/jpeg':
				$image =imagecreatefromjpeg($imagePath);
				break;
			case 'image/wbmp':
				$image =imagecreatefromwbmp($imagePath);
				break;
		}
		return $image;
	}
}
