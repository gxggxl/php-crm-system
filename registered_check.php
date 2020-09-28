<?php
// 引入数据库操作文件
include "database/conn.php";
header('content-type:text/html;charset=utf-8');
// 删除左侧空格
$username   = trim($_POST["username"]);
$email      = trim($_POST["email"]);
$sex        = $_POST["sex"];
$phonenum   = trim($_POST["phonenum"]);
$pwd        = trim($_POST["pwd"]);
$pwd1       = trim($_POST["pwd1"]);
$createtime = time();
// Y ：年（四位数）大写
// m : 月（两位数，首位不足补0） 小写
// d ：日（两位数，首位不足补0） 小写
// H：小时 带有首位零的 24 小时小时格式
// h ：小时 带有首位零的 12 小时小时格式
// i ：带有首位零的分钟
// s ：带有首位零的秒（00 -59）
// a：小写的午前和午后（am 或 pm）
// $time = date('Y-m-s H:i:s',time());

// 没加盐的md5加密
$password = md5($pwd);

if (isset($_POST['username'])) {
	$sql = "SELECT * FROM crm_users WHERE username='{$_POST['username']}'";
	$res = (bool) $db->read_one($sql);
	if ($res) {
		exit("用户名"."{$_POST['username']}" ."已注册");
	}
}
if (isset($_POST['email'])) {
	$sql = "SELECT * FROM crm_users WHERE email='{$_POST['email']}'";
	$res = (bool) $db->read_one($sql);
	if ($res) {
		exit("{$_POST['email']}" ."邮箱已注册");
	}
}
if (isset($_POST['phonenum'])) {
	$sql = "SELECT * FROM crm_users WHERE phonenum='{$_POST['phonenum']}'";
	$res = (bool) $db->read_one($sql);
	if ($res) {
		exit("手机号码:"."{$_POST['phonenum']}" ."已注册");
	}
}

if ((isset($pwd) == isset($pwd1)) && isset($username)) {
	$sql = "INSERT INTO `crm_users`(`username`, `password`, `email`, `sex`, `phonenum`, `createtime`) VALUES ('{$username}','{$password}','{$email}','{$sex}','{$phonenum}','{$createtime}')";
	$res = $db->write($sql);
	$uid = $db->insert_id();
	echo "注册成功，你的ID为 ".$uid."用户名为：".$username;
	// var_dump($res);//int(1)
} else {
	echo "注册失败，请检查表单是否填写正确。";
}
