<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-20 13:09:48
 * @LastEditTime : 2020-09-28 19:40:07
 * @FilePath     : /php-crm-system/database/mysqli.php
 */

# 数据库操作类
class Sql {
	# 定义属性:保存数据库初始化的信息
	# 主机
	private $host;
	# 端口
	private $port;
	# 数据库用户名
	private $user;
	# 数据库密码
	private $password;
	# 数据库名
	private $dbname;
	# 字符集
	private $charset;
	# 数据库连接字符串
	private $link;
	# 列数
	public $columns = 0;
	# 行数
	public $rows;
	# 二维数组
	public $list;
	# 错误编码
	public $errno;
	# 错误信息
	public $error;

	# 实现数据的初始化：灵活性(允许外部修改)和通用性(给定默认值)

	/**
	 * Sql constructor.
	 * @param array $arr
	 */
	public function __construct(array $arr = []) {
		# 完成初始化
		$this->host     = $arr['host']??'localhost';
		$this->user     = $arr['user']??'root';
		$this->password = $arr['password']??'root';
		$this->dbname   = $arr['dbname']??'test';
		$this->port     = $arr['port']??'3306';
		$this->charset  = $arr['charset']??'utf8';

		# 实现初始化数据库操作
		if (!$this->connect()) return;
		# 设置字符集
		$this->charset();
	}

	/**
	 * [connect 连接认证]
	 * @return bool
	 */
	private function connect() {
		$this->link = @mysqli_connect($this->host, $this->user, $this->password,
			$this->dbname, $this->port, );
		# 加工结果
		if (!$this->link) {
			# 记录错误信息，返回false
			echo "数据库连接失败<br>";
			echo "错误编码:".$this->errno = mysqli_connect_errno()."<br>";
			echo "错误信息:".$this->error = mysqli_connect_error()."<br>";
			return false;
		}
		# 正确返回
		return true;
	}

	/**
	 * [charset 设置字符集]
	 * @return bool [返回结果]
	 */
	private function charset() {
		# 利用实现mysqli设置字符集
		$res = @mysqli_set_charset($this->link, $this->charset);
		# mysqli_query($this->link,"set names {$this->charset}");
		# 判定错误
		if (!$res) {
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

	/**
	 * [check SQL语句检查]
	 * @param  [string] $sql [sql语句]
	 * @return bool|mysqli_result [返回结果]
	 */
	private function check($sql) {
		$res = @mysqli_query($this->link, $sql);
		# 判定错误
		if (!$res) {
			$this->errno = mysqli_errno($this->link);
			$this->error = mysqli_error($this->link);
			return false;
		}
		# 正确返回
		return $res;
	}

	/**
	 * [write 数据库写操作]
	 * @param  [string] $sql [数据库语句]
	 * @return bool|int  [返回受影响的行数]
	 */
	public function write($sql) {
		# 调用SQL检查方法检查和执行
		$res = $this->check($sql);
		# 根据结果判定:如果$res为true, 说明执行成功，应该获取受影响的行数，如果为false就返回false
		return $res?mysqli_affected_rows($this->link):false;
	}

	/**
	 * [insert_id 获取自增长ID的方法]
	 * @return int|string [返回最后一个查询中自动生成的 ID]
	 */
	public function insert_id() {
		return mysqli_insert_id($this->link);
	}

	/**
	 * [read_one 读取一条记录]
	 * @param  [string] $sql [数据库语句]
	 * @return bool|string[]|null  [一维数组]
	 */
	public function read_one($sql) {
		# 执行检查
		$res = $this->check($sql);
		# 判定结果
		if ($res) {
			# 有结果
			$this->columns = @mysqli_field_count($this->link);
			return mysqli_fetch_assoc($res);
		}
		# 没有结果
		return false;
	}

	/**
	 * [read_all 读取多条数据]
	 * @param  [string] $sql [数据库语句]
	 * @return array|bool  [二维数组]
	 */
	public function read_all($sql) {
		# 执行检查
		$res = $this->check($sql);
		# 错误检查
		if (!$res) {return false;
		}
		# 结果正确 记录结果数量
		$this->rows    = @mysqli_num_rows($res);
		$this->columns = @mysqli_field_count($this->link);
		# 根据需求解析数据 循环取出所有记录:形成二维数组
		$list = [];
		while ($row = mysqli_fetch_assoc($res))$list[] = $row;
		# 返回结果
		return $list;
	}
}
