<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-27 14:41:08
 * @LastEditTime : 2020-10-09 21:13:40
 * @FilePath     : /php-crm-system/page/demo.php
 */
//引入分页类
include "page.class.php";
header("Content-Type:text/html;charset=utf-8");
//数据库连接资源
$link = mysqli_connect("127.0.0.1", "test", "123456", "test");
//得到结果集
$result = mysqli_query($link, "SELECT * FROM crm_users");
//获取记录总条数
$total = mysqli_num_rows($result);
//设计每页显示条数
$pageSize = isset($_GET['size']) ? $_GET['size'] : 5;

// $we ="select * FROM `crm_users` WHERE `username` LIKE '%admin%'";

//实例化分页类，$total(总条数)，$pageSize(每页显示条数)
$page = new Page($total, $pageSize);
//拿到分页查询条件
$limit = $page->limit();
//sql语句
$sql = "SELECT * FROM crm_users LIMIT {$limit}";
//查询数据
$result = mysqli_query($link, $sql);

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
