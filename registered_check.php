<?php
// 引入数据库操作文件
include "database/conn.php";
header('content-type:text/html;charset=utf-8');
// 删除左侧空格
$username = trim($_POST["username"]);
$email = trim($_POST["email"]);
$sex = $_POST["sex"];
$phone_num = $_POST["phone_num"];
$pwd = trim($_POST["pwd"]);
$pwd1 = trim($_POST["pwd1"]);
$create_time = time();
$ip = $_SERVER['SERVER_ADDR'];

// 没加盐的md5加密
$password = md5($pwd);

if (isset($_POST['username'])) {
	$sql = "SELECT * FROM crm_users WHERE username='{$_POST['username']}'";
	$res = (bool)$db->readOne($sql);
	if ($res) {
		exit("用户名" . ($_POST['username']) . "已注册");
	}
}
if (isset($_POST['email'])) {
	$sql = "SELECT * FROM crm_users WHERE email='{$_POST['email']}'";
	$res = (bool)$db->readOne($sql);
	if ($res) {
		exit(($_POST['email']) . "邮箱已注册");
	}
}
if (isset($_POST['phone_num'])) {
	$sql = "SELECT * FROM crm_users WHERE phone_num='{$_POST['phone_num']}'";
	$res = (bool)$db->readOne($sql);
	if ($res) {
		exit("手机号码:" . ($_POST['phone_num']) . "已注册");
	}
}

if (isset($pwd) == isset($pwd1) && ($username != null)) {
	$sql = "INSERT INTO `crm_users`(`username`, `password`, `email`, `sex`, phone_num, `create_time`,`ip`)"
		. " VALUES ('{$username}','{$password}','{$email}','{$sex}','{$phone_num}','{$create_time}','{$ip}')";
	$res = $db->write($sql);
	$uid = $db->insert_id();
	echo "注册成功，你的ID为 " . $uid . "用户名为：" . $username.'手机号码为：'.$phone_num;
	// var_dump($res);//int(1)
} else {
	exit("<script>alert('注册失败，请检查表单是否填写正确。');window.location='registered.php';</script>");
}
