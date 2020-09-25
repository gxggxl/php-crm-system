<?php 
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-20 13:09:48
 * @LastEditTime : 2020-09-20 19:27:49
 * @FilePath     : /php-crm-system/sql.php
 */
#数据库操作类
class Sql{
	#定义属性:保存数据库初始化的信息
	#主机
	private $host;
	#端口
	private $port;
	#数据库用户名
	private $user;
	#数据库密码
	private $password;
	#数据库名
	private $dbname;
	#字符集
	private $charset;
	#数据库连接字符串
	private $link;
	#错误编码
	public $errno;
	#错误信息
	public $error;
	#列数
	public $columns = 0;
	#行数
	public $rows;
	#二维数组
	public $list; 

	# 实现数据的初始化：灵活性(允许外部修改)和通用性(给定默认值)
	public function __construct(array $arr = []){
		# 完成初始化
		$this->host = $arr['host'] ?? 'localhost';
		$this->port = $arr['port'] ?? '3306';
		$this->user = $arr['user'] ?? 'root';
		$this->password = $arr['password'] ?? 'root';
		$this->dbname = $arr['dbname'] ?? 'test';
		$this->charset = $arr['charset'] ?? 'utf8';
		
		# 实现初始化数据库操作
		# 为了中断执行
		if(!$this->connect()) return;
		# 设置字符集
		$this->charset();
		//
		//                       _oo0oo_
		//                      o8888888o
		//                      88" . "88
		//                      (| -_- |)
		//                      0\  =  /0
		//                    ___/`---'\___
		//                  .' \\|     |// '.
		//                 / \\|||  :  |||// \
		//                / _||||| -:- |||||- \
		//               |   | \\\  - /// |   |
		//               | \_|  ''\---/''  |_/ |
		//               \  .-\__  '-'  ___/-. /
		//             ___'. .'  /--.--\  `. .'___
		//          ."" '<  `.___\_<|>_/___.' >' "".
		//         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
		//         \  \ `_.   \_ __\ /__ _/   .-` /  /
		//     =====`-.____`.___ \_____/___.-`___.-'=====
		//                       `=---='
		//
		//
		//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		//
		//           佛祖保佑       永不宕机     永无BUG
	}
	
	# 连接认证
	private function connect(){
		$this->link = @mysqli_connect($this->host,$this->user,$this->password,$this->dbname,$this->port);
		# 加工结果
		if(!$this->link){
			# 记录错误信息，返回false
			echo "数据库连接失败<br>";
			echo "错误编码:".mysqli_connect_errno($this->link)."<br>";
			echo "错误信息:".mysqli_connect_error($this->link)."<br>";
			// $this->errno = mysqli_connect_errno();
			// $this->error = mysqli_connect_error();
			return false;
		}
		# 正确返回
		return true;
	}
	
	# 设置字符集
	private function charset(){
		# 利用实现mysqli设置字符集
		$res = @mysqli_set_charset($this->link,$this->charset);
		#mysqli_query($this->link,"set names {$this->charset}");
		
		# 判定错误
		if(!$res){
			echo "设置字符集失败<br>";
			echo "错误编码:".$this->errno = mysqli_errno($this->link)."<br>";
			echo "错误信息:".$this->error = mysqli_error($this->link)."<br>";
			// $this->errno = mysqli_errno($this->link);
			// $this->error = mysqli_error($this->link);
			return false;
		}
		# 正确返回
		return true;
	}
	
	# SQL执行检查
	private function check($sql){
		$res = @mysqli_query($this->link,$sql);
		
		# 判定错误
		if(!$res){
			$this->errno = mysqli_errno($this->link);
			$this->error = mysqli_error($this->link);
			return false;
		}
		# 正确返回
		return $res;
	}
	
	# SQL写操作
	public function write($sql){
		# 调用SQL检查方法检查和执行
		$res = $this->check($sql);
		# 根据结果判定:如果$res为true, 说明执行成功，应该获取受影响的行数，如果为false就返回false
		return $res ? mysqli_affected_rows($this->link) : false;
	}
	# 获取自增长ID的方法
	public function insert_id(){
		return mysqli_insert_id($this->link);
	}
	
	# 读取数据:一条记录
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

#接上述代码(类外测试)

/*
$s2 = new Sql($info);

$tiem = time();
// var_dump($s2->connect());
// var_dump($s2->charset());
// var_dump($s2->check('select * from user'));
$res = $s2->read_all('desc user');
// var_dump($res);
$res1 = $s2->write("insert into user values ('','admin','123456','$tiem')");
var_dump($res1);
echo '自增长ID'.$s2->insert_id();

echo $s2->errno,$s2->error;
*/

?>
