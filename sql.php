<?php 

#数据库操作类
class Sql{
	#定义属性:保存数据库初始化的信息
	public $host;
	public $port;
	public $user;
	public $password;
	public $dbname;
	public $charset;
	
	#使用外部数据库信息
	#构造方法初始化数据:数据较多，应该使用数组来传递数据，关联数组，而且绝大部分的开发者本意是用来测试，所以基本都是本地，因此可以给默认数据
	/*
	$info = array(
		'host' => 'localhost',
		'port' => '3306 ',
		'user' => 'root',
		'pass' => 'root',
		'dbname' => 'blog',
		'charset' => 'utf8'
	)
	*/
	#实现数据的初始化：灵活性(允许外部修改)和通用性(给定默认值)
	public function __construct(array $arr = []){
		# 完成初始化
		$this->host = $arr['host'] ?? 'localhost';
		$this->port = $arr['port'] ?? '3306';
		$this->user = $arr['user'] ?? 'root';
		$this->password =$arr['password'] ?? '';
		$this->dbname = $arr['dbname'] ?? 'test';
		$this->charset = $arr['charset'] ?? 'utf-8';
	}
	
	#连接认证
	public function 
}

#接上述代码(类外测试)
$s1 = new Sql();
#使用默认数据库信息
$db = array(
	'host' => 'localhost',
	'port' => '3306',
	'user' => 'root',
	'password' => '',
	'dbname' => 'test'
);

$s2 = new SqL($db);
var_dump($s2);
