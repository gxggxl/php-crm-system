<?php
include_once "head.php";
include_once "database/conn.php";

$sql = "SELECT * FROM crm_users WHERE username='{$_COOKIE['username']}'";
$res = $db->read_one($sql);
var_dump($res);
echo "uid:".$res['uid']."<br>";
echo "用户名:".$res['username']."<br>";
echo "性别:".$res['sex']."<br>";
echo "邮箱:".$res['email']."<br>";
echo "手机:".$res['phonenum']."<br>";

include 'footer.php';