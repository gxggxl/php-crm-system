<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-27 14:41:08
 * @LastEditTime : 2020-09-27 20:11:29
 * @FilePath     : /php-crm-system/page/demo.php
 */

header("Content-Type:text/html;charset=utf-8");
include "page.class.php";

$link=mysqli_connect("127.0.0.1","test","123456","test");

$result=mysqli_query($link,"select * from crm_users");

$total=mysqli_num_rows($result);

$num=5;

$page=new Page($total,$num);

$sql="select * from crm_users {$page->limit}";

$result = mysqli_query($link,$sql);

echo '<table border="1" align="center" cellspacing="" cellpadding="" width="900">';
echo '<caption><h1>Users</h1></caption>';
echo '<tr><th>uid</th><th>username</th><th>sex</th><th>email</th><th>phonenum</th><th>createtime</th></tr>';
	while($row=mysqli_fetch_assoc($result)){
		echo '<tr>';
		echo '<td>'.$row["uid"].'</td>';
		echo '<td>'.$row["username"].'</td>';
		echo '<td>'.$row["sex"].'</td>';
		echo '<td>'.$row["email"].'</td>';
		echo '<td>'.$row["phonenum"].'</td>';
		echo '<td>'.$row["createtime"].'</td>';
		echo '<tr>';
	}
echo '<tr><td colspan="6" align="right">'.$page->fpage().'</td></tr>';
echo '</table>';

?>

