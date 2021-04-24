<?php

namespace model;
class Model
{
	// 主机名
	protected $host;
	// 数据库用户名
	protected $user;
	// 数据库密码
	protected $pwd;
	// 数据库名
	protected $dbname;
	// 字符集
	protected $charset;
	// 数据表前缀
	protected $prefix;

	// 数据库连接资源
	protected $link;
	// 数据表名 这里可以自己指定表名
	protected $tableName;

	//sql语句
	protected $sql;
	// 操作数组 存放的是所有的查询条件
	protected $options;

	// 构造方法,对成员变量初始化
	function __construct($config)
	{
		// 对成员属性一一初始化
		$this->host = $config['DB_HOST'];
		$this->user = $config['DB_USER'];
		$this->pwd = $config['DB_PWD'];
		$this->dbname = $config['DB_NAME'];
		$this->charset = $config['DB_CHARSET'];
		$this->prefix = $config['DB_PREFIX'];


		// 连接数据库
		$this->link = $this->connect();

		// 得到数据库表名  user ===> userModel
		$this->tableName = $this->getTableName();

		// 初始化options数组
		$this->initOptions();
	}

	protected function getTableName()
	{
		// 1.如果设置了成员变量,通过成员变量得到表明
		if(!empty($this->tableName))
		{
			return $this->prefix.$this->tableName;
		}
		// 2.如果没有,就通过类名得到表名
		// 得到当前类名字符串
		$className = get_class($this);
		// user UserModel goods GoodsModel
		// 截取首字母至倒数第五个字母,并转换为小写字母
		$table = strtolower(substr($className, 0,-5));
		return $this->prefix.$table;
	}

	protected function connect()
	{
		// 连接数据库
		$link = mysqli_connect($this->host,$this->user,$this->pwd);
		if(!$link){
			die('数据库连接失败! '.mysqli_connect_error());
		}
		// 选择数据库
		mysqli_select_db($link, $this->dbname);
		// 设置字符集
		mysqli_set_charset($link, $this->charset);
		// 返回连接成功的资源
		return $link;
	}

	protected function initOptions()
	{
		$arr = ['where','table','field','order','group','having','limit'];
		foreach($arr as $value)
		{
			// 将options数组中这些键对应的值全部清空
			$this->options[$value] = '';
			// 将table默认设置为tableName
			if ($value == 'table'){
				$this->options[$value] = $this->tableName;
			}else if ($value == 'field'){
				$this->options[$value] = '*';
			}
		}
	}
	// field方法
	function field($field)
	{
		// 如果不为空,再进行处理
		if (!empty($field)){
			if(is_string($field)){
				$this->options['field'] = $field;
			}else if(is_array($field)){
				$this->options['field'] = join(',',$field);
			}
		}
		return $this;
	}
	// table方法
	function table($table)
	{
		if(!empty($table)){
			$this->options['table'] = $table;
		}
		return $this;
	}
	// where方法
	function where($where)
	{
		if(!empty($where)){
			$this->options['where'] = 'where '.$where;
		}
		return $this;
	}
	// group方法
	function group($group)
	{
		if(!empty($group)){
			$this->options['group'] = 'group by '.$group;
		}
		return $this;
	}
	// having方法
	function having($having)
	{
		if(!empty($having)){
			$this->options['having'] = 'having '.$having;
		}
		return $this;
	}
	// order方法
	function order($order)
	{
		if(!empty($order)){
			$this->options['order'] = 'order by '.$order;
		}
		return $this;
	}
	// limit方法
	function limit($limit)
	{
		if(!empty($limit))
		{
			if(is_string($limit)){
				$this->options['limit'] = 'limit '.$limit;
			}else if (is_string($limit)){
				$this->options['limit'] = 'limit '.join(',',$limit);
			}
		}
		return $this;
	}
	// select方法
	function select()
	{
		// 先预写一个带有占位符的sql语句
		$sql = 'select %FIELD% from %TABLE% %WHERE% %GROUP% %HAVING% %ORDER% %LIMIT%';
		$sql = str_replace(['%FIELD%','%TABLE%','%WHERE%','%GROUP%','%HAVING%','%ORDER%','%LIMIT%'],
			[$this->options['field'],$this->options['table'],$this->options['where'],
			$this->options['group'],$this->options['having'],$this->options['order'],
			$this->options['limit']], $sql);
		// 保存一份sql语句
		$this->sql = $sql;
		// 执行sql语句
		return $this->query($sql);
	}
	// query 查询,要结果集
	function query($sql)
	{
		// 清空options数组中的值
		$this->initOptions();
		// 执行sql语句
		$result = mysqli_query($this->link, $sql);
		// 提取结果放到数组中
		if ($result && mysqli_affected_rows($this->link)){
			while ($data = mysqli_fetch_assoc($result)){
				$newData[] = $data;
			}
		}
		$rows = mysqli_affected_rows($this->link);
		// 返回结果集
		return [$newData,$rows];
	}

	// 获取sql语句
	function __get($name)
	{
		if ($name == 'sql'){
			return $this->sql;
		}else{
			return false;
		}
	}

	// insert函数
	// $data:关联数组, 键就是字段名, 值是字段值
	// insert into 表名(字段名) value(值)
	function insert($data)
	{
		// 处理值是字符串问题, 两边需要添加单或双引号
		$data = $this->parseValue($data);
		// 提取所有的键,即所有的字段
		$keys = array_keys($data);
		// 提取所有的值
		$value = array_values($data);
		$sql = 'insert into %TABLE%(%FIELD%) values(%VALUES%)';
		$sql = str_replace(
			['%TABLE%', '%FIELD%', '%VALUES%'], 
			[$this->options['table'], join(',', $keys),
			join(',', $value)], $sql);
		$this->sql = $sql;
		return $this->exec($sql, true);
	}

	// exec 不需要结果集
	function exec($sql, $isInsert = false)
	{
		// 清空options数组中的值
		$this->initOptions();
		// 执行sql语句
		$result = mysqli_query($this->link, $sql);
		if($result && mysqli_affected_rows($this->link))
		{	
			// 判断是否为插入语句,根据不同的语句返回不同的结果
			if($isInsert){
				return mysqli_insert_id($this->link);
			}else{
				return mysqli_affected_rows($this->link);
			}
		}
		return false;
	}

	// 传递过来一个数组, 将数组中值为字符串的两边加上引号
	protected function parseValue($data)
	{
		// 遍历数组,判断是否为字符串
		foreach ($data as $key => $value) 
		{
			if (is_string($value)){
				$value = '"'.$value.'"';
			}
			$newData[$key] = $value;
		}
		// 返回处理后的数组
		return $newData;
	}

	// delete函数
	function delete()
	{
		// 拼接sql语句
		$sql = 'delete from %TABLE% %WHERE%';
		$sql = str_replace(['%TABLE%', '%WHERE%'], [$this->options['table'], $this->options['where']], $sql);
		// 保存sql语句
		$this->sql = $sql;
		// 执行sql语句
		return $this->exec($sql);
	}
	// update函数
	// update 表名 set 字段名=字段值, where
	function update($data)
	{
		// 处理$data数组中值为字符串加引号的问题
		$data = $this->parseValue($data);
		// 将关联数组拼接为固定的格式  键=值, 键=值
		$value = $this->parseUpdate($data);
		// 准备sql语句
		$sql = 'update %TABLE% set %VALUE% %WHERE%';
		$sql = str_replace(['%TABLE%', '%VALUE%', '%WHERE%'], [$this->options['table'], $value, $this->options['where']], $sql);
		// 保存sqlyuj
		$this->sql = $sql;
		// 执行sql语句
		return $this->exec($sql);
	}
	protected function parseUpdate($data)
	{
		foreach ($data as $key => $value) {
			$newData[] = $key.'='.$value;
		}
		return join(',', $newData);
	}

	// max函数
	function max($field)
	{
		// 通过调用自己封装的方法进行查询
		$result = $this->field('max('.$field.') as max')->select();
		// select方法返回的是一个二维数组
		return $result[0]['max'];
	}

	// 析构方法
	function __destruct()
	{
		mysqli_close($this->link);
	}

	// getByName getByAge __call方法
	function __call($name, $args)
	{
		// 获取前五个字符
		$str = substr($name, 0, 5);
		// 获取后面的字段名
		$field = strtolower(substr($name, 5));
		// 判断前五个字符是否是getBy
		if ($str == 'getBy'){
			return $this->where($field.'="'.$args[0].'"')->select();
		}
		return false;
	}

}