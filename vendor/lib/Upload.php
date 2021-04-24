<?php


namespace framework;
class Upload
{
	// 上传文件保存路径
	protected $path = './upload/';
	// 允许的文件后缀
	protected $allowSubfix = ['jpg','jpeg','gif','png','wbmp'];
	// 允许的mime类型
	protected $allowMime = ['image/jpeg','image/gif','image/png','image/wbmp'];
	// 文件最大尺寸
	protected $maxSize = 2000000;
	// 是否启用随机名
	protected $isRandName = true;
	// 上传文件前缀
	protected $prefix = 'up_';

	// 错误号码和错误信息
	protected $errorNumber;
	protected $errorInfo;

	//文件的信息
	protected $oldname;
	protected $subfix;
	protected $size;
	protected $mime;
	protected $tmpName;

	// 文件新名字
	public $newName;

	public function __construct($arr = [])
	{
		foreach ($arr as $key => $value){
			$this->setOption($key, $value);
		}
		$this->setOption($key,$value);

	}

	protected function setOption($key,$value)
	{
		// 得到所有的成员属性
		$keys = array_keys(get_class_vars(__CLASS__));
		//如多$key是我的成员属性,那么设置
		if (in_array($key,$keys)){
			$this->key = $value;
		}
	}

	// 文件上传函数(核心函数)
	// $key是前端input框中的name属性值
	public function uploadFile($key)
	{
		// 判断有没有设置路径 path
		if(empty($this->path)){
			$this->setOption('errorNumber',-1);
			return false;
		}
		// 判断该路径是否存在且可写
		if(!$this->check()){
			$this->setOption('errorNumber',-2);
			return false;
		}
		/*	
			判断$_FILES里面的erroe信息是否为0,
			如果为0,说明文件信息可以在服务器端
			直接获取,提取信息保存到成员属性中
		*/
		$error = $_FILES[$key]['error'];
		if ($error){
			$this->setOption('errorNumber',$error);
			return false;
		}else{
			// 提取文件相关信息,并保存到成员属性中
			$this->getFileInfo($key);
		}
		// 判断文件的大小,mime,后缀是否合法
		if (!$this->checkSize() || !$this->checkMime() || !$this->checkSubfix()) {
			return false;
		}
		// 得到新文件的名字
		$this->newName = $this->createNewName();
		// 判断是否为上传文件,并且移动上传文件
		if(is_uploaded_file($this->tmpName))
		{
			if (move_uploaded_file($this->tmpName, $this->path.$this->newName)){
				return $this->path.$this->newName;
			}else{
				$this->setOption('errorNumber',-7);
				return false;
			}

		}else{
			$this->setOption('errorNumber',-6);
			return false;
		}

	}

	// 得到新文件名函数
	protected function createNewName()
	{
		if ($this->isRandName){
			$name = $this->prefix.uniqid().'.'.$this->subfix;
		}else{
			$name = $this->prefix.$this->oldname;
		}
		return $name;
	}

	protected function check()
	{
		// 文件夹不存在或者不是目录
		if (!file_exists($this->path) || !is_dir($this->path)){
			return mkdir($this->path,0777,true);
		}

		// 判断文件夹是否可写
		if (!is_writable($this->path)){
			return chmod($this->path,0777);
		}
		return true;
	}

	protected function getFileInfo($key)
	{
		// 得到文件名字
		$this->oldName = $_FILES[$key]['name'];
		// 得到文件mime类型
		$this->mime = $_FILES[$key]['type'];
		// 得到文件大小
		$this->size = $_FILES[$key]['size'];
		// 得到文件临时路径
		$this->tmpName = $_FILES[$key]['tmp_name'];
		// 得到文件后缀
		$this->subfix = pathinfo($this->oldName)['extension'];
	}

	// 判断文件大小是否合法
	protected function checkSize()
	{
		if ($this->size > $this->maxSize){
			$this->setOption('errorNumber',-3);
		}
		return true;
	}

	protected function checkMime()
	{
		if(!in_array($this->mime,$this->allowMime)){
			$this->setOption('errorNumber',-4);
			return false;
		}
		return true;
	}

	protected function checkSubfix()
	{
		if (!in_array($this->subfix, $this->allowSubfix)){
			$this->setOption('errorNumber',-5);
			return false;
		}
		return true;
	}

	public function __get($name)
	{
		if ($name == 'errorNumber'){
			return $this->errorNumber;
		}else if ($name == 'errorInfo'){
			return $this->getErrorInfo();
		}
	}

	protected function getErrorInfo()
	{
		switch ($this->errorNumber){
			case -1:
				$str = '文件路径没有设置';
				break;
			case -2:
				$str = '文件路径不是目录或者没有权限';
				break;
			case -3:
				$str = '文件超过最大限制';
				break;
			case -4:
				$str = '文件mime类型不符合';
				break;
			case -5:
				$str = '文件后缀不符合';
				break;
			case -6:
				$str = '不是上传文件';
				break;
			case -7:
				$str = '文件上传失败';
				break;
			case 1:
				$str = '上传的文件超过了不能超过2M。';
				break;
			case 2:
				$str = '上传文件的大大小超过限制';
				break;
			case 3:
				$str = '文件只有部分被上传。';
				break;
			case 4:
				$str = '没有文件被上传。';
				break;
			case 6:
				$str = '找不到临时文件夹';
				break;
			case 7:
				$str = '文件写入失败.';
				break;
		}
		return $str;
	}
}