<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-27 14:41:08
 * @LastEditTime : 2020-10-09 21:13:40
 * @FilePath     : /php-crm-system/page/demo.php
 */
include "page.class.php";
header("Content-Type:text/html;charset=utf-8");

$link = mysqli_connect("127.0.0.1", "test", "123456", "test");
$result = mysqli_query($link, "select * from crm_users");
//获取记录总条数
$total = mysqli_num_rows($result);
$pageSize = isset($_GET['size']) ? $_GET['size'] : 5;

// $we ="select * FROM `crm_users` WHERE `username` LIKE '%admin%'";

$page = new Page($total, $pageSize);
// var_dump($page);
$limit = $page->limit();

$sql = "select * from crm_users limit {$limit}";
$result = mysqli_query($link, $sql);
// var_dump($result);
echo '<table border="1" align="center" cellspacing="" cellpadding="" width="760">';
echo '<caption><h1>Users</h1></caption>';
echo '<tr><th>uid</th><th>username</th><th>sex</th><th>email</th><th>phonenum</th><th>createtime</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row["uid"] . '</td>';
    echo '<td>' . $row["username"] . '</td>';
    echo '<td>' . $row["sex"] . '</td>';
    echo '<td>' . $row["email"] . '</td>';
    echo '<td>' . $row["phonenum"] . '</td>';
    echo '<td>' . date('Y年m月d日 H:i:s', $row["createtime"]) . '</td>';
    echo '<tr>';
}
echo '<tr><td colspan="6" align="right">' . $page->showPage() . '</td></tr>';
echo '</table>';
