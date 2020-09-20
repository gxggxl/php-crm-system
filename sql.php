<?php 
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-20 13:09:48
 * @LastEditTime : 2020-09-20 13:58:07
 * @FilePath     : /php-crm-system/sql.php
 */
include_once 'config.php';
#数据库操作类
class Sql{
	#定义属性:保存数据库初始化的信息
	private $host;#主机
	private $port;#端口
	private $user;#数据库用户名
	private $password;#数据库密码
	private $dbname;#数据库名
	private $charset;#字符集
	private $link;#数据库连接字符串
	public $errno;#错误编码
	public $error;#错误信息
	public $columns = 0;#列数
	public $rows;#行数
	public $list; #二维数组
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
		$this->password = $arr['password'] ?? '';
		$this->dbname = $arr['dbname'] ?? 'test';
		$this->charset = $arr['charset'] ?? 'utf8';
		
		#实现初始化数据库操作
		if(!$this->connect()) return;
		#为了中断执行
		$this->charset();
	}
	
	#连接认证
	private function connect(){
		$this->link = @mysqli_connect($this->host,$this->user,$this->password,$this->dbname,$this->port);
		#加工结果
		if(!$this->link){
			#记录错误信息，返回false
			echo "数据库连接失败<br>";
			echo "错误编码:".mysqli_connect_errno($this->link)."<br>";
			echo "错误信息:".mysqli_connect_error($this->link)."<br>";
			// $this->errno = mysqli_connect_errno();
			// $this->error = mysqli_connect_error();
			return false;
		}
		#正确返回
		return true;
	}
	#设置字符集
	private function charset(){
		#利用实现mysqli设置字符集
		$res = @mysqli_set_charset($this->link,$this->charset);#mysqli_query($this->link,"set names {$this->charset}");
		
		#判定错误
		if(!$res){
			echo "设置字符集失败<br>";
			echo "错误编码:".$this->errno = mysqli_errno($this->link)."<br>";
			echo "错误信息:".$this->error = mysqli_error($this->link)."<br>";
			// $this->errno = mysqli_errno($this->link);
			// $this->error = mysqli_error($this->link);
			return false;
		}
		#正确返回
		return true;
	}
	#SQL执行检查
	private function check($sql){
		$res = @mysqli_query($this->link,$sql);
		
		#判定错误
		if(!$res){
			$this->errno = mysqli_errno($this->link);
			$this->error = mysqli_error($this->link);
			return false;
		}
		#正确返回
		return $res;
	}
	
	#SQL写操作
	public function write($sql){
		#调用SQL检查方法检查和执行
		$res = $this->check($sql);
		#根据结果判定:如果$res为true, 说明执行成功，应该获取受影响的行数，如果为false就返回false
		return $res ? mysqli_affected_rows($this->link) : false;
	}
	#获取自增长ID的方法
	public function insert_id(){
		return mysqli_insert_id($this->link);
	}
	
	#读取数据:一条记录
	public function read_one($sql){
		#执行检查
		$res = $this->check($sql);
		#判定结果
		if($res){
		#有结果
		$this->columns = @mysqli_field_count($this->link);
			return mysqli_fetch_assoc($res);
		}
		#没有结果
		return false;
	}
	
	#读取多条数据
	public function read_all($sql){
		#执行检查
		$res = $this->check($sql);
		
		#错误检查
		if( !$res) return false;
		#结果正确 记录结果数量
		$this->rows = @mysqli_num_rows($res);
		$this->columns = @mysqli_field_count($this->link);
		
		#根据需求解析数据 循环取出所有记录:形成二维数组
		$list = [];
		while($row = mysqli_fetch_assoc($res)) $list[] = $row;
		#返回结果
		return $list;
	}
}

/*
小结
1、类的封装是以功能驱动为前提,相关操作存放到一个类中
2、一个类通常是一个独立的文件,文件名与类名相同(方便后期维护和自动加载)
3、类中如果有数据需要管理，设定属性
4、类中如果有功能需要实现(数据加工)，设定方法
5、一个功能通常使用一个方法实现，方法的颗粒度应该尽可能小(方便复用)
6、应该尽可能增加类对成员的控制:即能私有尽可能私有
7、类中需要实现的功能应该由具体的业务来实现支撑
	●实用类:只考虑当前业务，不考虑全面性(代码少,应用范围小)
	●工具类:全面综合考虑，尽可能多的封装可能存在的业务(代码多,应用范围广)
*/

#接上述代码(类外测试)
$s2 = new Sql($info);

$tiem = time();
// var_dump($s2->connect());
// var_dump($s2->charset());
// var_dump($s2->check('select * from user'));
$res = $s2->read_all('desc user');

$res1 = $s2->write("insert into user values ('','admin','123456','$tiem')");
var_dump($res1);
echo '自增长ID'.$s2->insert_id();
// var_dump($res);
// var_dump($s2->read_all('select * from user'));

echo $s2->errno,$s2->error;

