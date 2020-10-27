# 分页类使用方法

```php
//引入分页类
include "page.class.php";
header("Content-Type:text/html;charset=utf-8");
//数据库连接资源
$link = mysqli_connect("127.0.0.1", "test", "123456", "test");
//得到结果集
$result = mysqli_query($link, "select * from crm_users");
//获取记录总条数
$total = mysqli_num_rows($result);
//设计每页显示条数
$pageSize = isset($_GET['size']) ? $_GET['size'] : 5;
//实例化分页类，$total(总条数)，$pageSize(每页显示条数)
$page = new Page($total, $pageSize);
//拿到分页查询条件
$limit = $page->limit();
//sql语句
$sql = "select * from crm_users limit {$limit}";
//查询数据
$result = mysqli_query($link, $sql);
//把结果在表格中显示
echo '<style>a{text-decoration: none;}</style>';
echo '<table border="1" style="width: 760px;margin: 50px auto;">';
echo '<caption><h1>Users</h1></caption>';
echo '<tr><th>uid</th><th>username</th><th>sex</th><th>email</th><th>phone_num</th><th>create_time</th></tr>';
//从结果集中取得一行作为关联数组
while ($row = mysqli_fetch_assoc($result)) {
	echo '<tr>';
	echo '<td>' . $row["uid"] . '</td>';
	echo '<td>' . $row["username"] . '</td>';
	echo '<td>' . $row["sex"] . '</td>';
	echo '<td>' . $row["email"] . '</td>';
	echo '<td>' . $row["phone_num"] . '</td>';
	echo '<td>' . date('Y年m月d日 H:i:s', $row["create_time"]) . '</td>';
	echo '<tr>';
}
echo '<tr><td colspan="6" style="text-align: right">' . $page->showPage() . '</td></tr>';
echo '</table>';
```

- 分页类效果
  ![分页类效果](https://cdn.jsdelivr.net/gh/gxggxl/oss@master/uPic/2020/10/27/SaaG5J.png)
- [演示地址](https://test.gxusb.com/page/demo.php)

## 拓展

- 另一种设置 url 地址的方法

```php
protected function getUrl(){
	//获取文件地址
	$path=$_SERVER['SCRIPT_NAME'];
	//获取主机名
	$host=$_SERVER['HTTP_HOST'];
	//获取端口号
	$port=$_SERVER['SERVER_PORT'];
	//获取协议
	$scheme=$_SERVER['REQUEST_SCHEME'];
	//获取参数
	$queryString=$_SERVER['QUERY_STRING'];
	if (strlen($queryString)) {
		//解析字符串返回数组
		parse_str($queryString,$array);
		unset($array['page']);

		$path=$path.'?'.http_build_query($array);
	}
	//拼接url地址
	$url=$scheme.'://'.$host.':'.$port.$path;
	//echo $url;
	//https://test.gxusb.com:443/page/demo.php?size=7&jsj=a
	return $url;
}
	//设置url 地址
	protected function setUrl($page){
		if (strstr($this->url,'?') ){
			return $this->url.'&page='.$page;
		}else{
			return $this->url.'?page='.$page;
		}
}
```