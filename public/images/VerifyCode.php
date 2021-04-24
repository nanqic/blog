<?php

session_start();

$code = new VerifyCode();
$code->outImage();
$vcode = strtolower($code->code);
$_SESSION['vcode'] = "$vcode";
class VerifyCode
{
	// 验证码个数
	protected $number;
	// 验证码类型
	protected $codeType;
	// 图像宽度
	protected $width;
	// 图像高度
	protected $height;
	// 验证码字符串
	protected $code;
	// 验证码图片
	protected $image;

	public function __construct($number = 4,$codeType = 2,$width = 102,$height = 45)
	{
		// 初始化自己的成员属性
		$this->number = $number;
		$this->codeType = $codeType;
		$this->width = $width;
		$this->height = $height;

		// 初始化成员方法
		$this->code = $this->createCode();

	}
	public function __get($name)
	{
		if($name = 'code')
		{
			return $this->code;
		}
	}

	public function  __destruct()
	{
		imagedestroy($this->image);
	}

	protected function createCode()
	{
		// 设置不同类型的验证码
		switch ($this->codeType) 
		{
			case 0: // 生成纯数字验证码
				$code = $this->getNumberCode();
				break;
			case 1: // 生成纯字母验证码
				$code = $this->getCharCode();
				break;
			case 2: // 生成字母数字混合验证码
				$code = $this->getNumberCharCode();
				break;
			default:
				die('不支持的验证码类型') ;
				break;
		}
		return $code;
	}
	// 数字验证码函数
	protected function getNumberCode()
	{
		$str = join('',range(0,9));
		return substr(str_shuffle($str), 0,$this->number);
	}

	// 字母验证码函数
	protected function getCharCode()
	{
		$str = join('',range('a','z'));
		$str = $str.strtoupper($str);
		return substr(str_shuffle($str), 0,$this->number);
	}

	// 字母数字混合函数
	protected function getNumberCharCode()
	{
		$numberStr = join('',range(0,9));
		$str = join('',range('a','z'));
		$str = $numberStr.$str.strtoupper($str);
		return substr(str_shuffle($str), 0,$this->number);
	}
	// 输出图像函数
	public function outImage()
	{
		// 创建画布
		$this->createImage();
		// 填充背景色
		$this->fillColor();
		// 将验证码画到画布中
		$this->drawCode();
		// 写干扰元素
		$this->drawDisturb();
		// 输出并显示
		$this->show();
	}
	protected function createImage()
	{
		$this->image = imagecreatetruecolor($this->width, $this->height);
	}
	protected function fillColor()
	{
		imagefill($this->image, 0, 0, $this->lightColor());
	}
	// 创建浅色
	protected function lightColor()
	{
		return imagecolorallocate($this->image, mt_rand(130,255), mt_rand(130,255), mt_rand(130,255));
	}
	// 创建深色
	protected function darkColor()
	{
		return imagecolorallocate($this->image, mt_rand(0,120), mt_rand(0,120), mt_rand(0,120));
	}
	protected function drawCode()
	{
		$width = ceil($this->width / $this->number);
		for($i = 0 ; $i < $this->number ; $i++)
		{
			$x = mt_rand($i*$width+5,($i+1)*$width-15);
			$y = mt_rand(10,$this->height - 20);
			imagechar($this->image, 5, $x, $y, $this->code[$i], $this->darkColor());
		}
	}
	protected function drawDisturb()
	{
		for($i = 0 ;$i < 150; $i++ )
		{
			$x = mt_rand(0,$this->width);
			$y = mt_rand(0,$this->height);
			imagesetpixel($this->image, $x, $y, $this->lightColor());
		}
	}
	protected function show()
	{
		header('Content-Type:image/png');
		imagepng($this->image);
	}
}