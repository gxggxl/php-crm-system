<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-24 22:05:04
 * @LastEditTime : 2020-09-24 22:33:06
 * @FilePath     : /php-crm-system/login_check.php
 */

include_once "database/conn.php";
// 删除左侧空格
$username = trim($_POST["username"]);
$password = md5(trim($_POST["password"]));
$remember = $_POST['remember'];
// $vcode = $_POST["vcode"];

// 验证登录状态
if (!empty($_COOKIE['username']) && !empty($_COOKIE['password'])) {
	//window.location.href = document.referrer;//返回上一页并刷新，真正实现页面后退并刷新页面
	exit("<script>alert('你已经登录！');window.location='user.php';</script>");
}

$sql = "SELECT username FROM crm_users WHERE username = '{$username}' AND password = '{$password}'";
if ($username == '' || $password == '') {
	echo $err_msg = "用户名和密码都不能为空";
} else {
	$row = $db->read_one($sql);
	if (empty($row)) {
		//开始判断是否为empty ( $row )空
		echo $err_msg = "用户名或密码不正确";
	} else {
		if (empty($remember)) {
			echo "登录成功";
			// 把用户名和加密的密码放到cookie里面
			setcookie("username", $username, "/");
			setcookie("password", $password, "/");
			header("refresh:0;url=user.php");
		}
		// session_start();
		$_SESSION['user_info'] = $row;
		if (!empty($remember)) {
			echo "登录成功";
			// 如果记住登陆，则记录登录状态，把用户名和加密的密码放到cookie里面
			setcookie("username", $username, time()+3600*24*7, "/");
			setcookie("password", $password, time()+3600*24*7, "/");
			header("refresh:0;url=user.php");
		}
	}
}

?>