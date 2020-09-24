<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-24 22:05:04
 * @LastEditTime : 2020-09-24 22:33:06
 * @FilePath     : /php-crm-system/login_check.php
 */

include_once "conn.php";

$username = $_POST["username"];
$password = md5 ($_POST["password"]);
$remember = $_POST ['remember'];

$sql="SELECT username FROM crm_users WHERE username = '{$username}' AND password = '{$password}'";
if ($username == '' || $password == '') {
	echo $err_msg = "用户名和密码都不能为空";
} else {
	$row = $db->read_one($sql);
	if (empty ( $row )) {
		echo $err_msg = "用户名和密码都不正确";
	} else {
		$_SESSION ['user_info'] = $row;
		if (! empty ( $remember )) {
			echo "登录成功";
			// 如果记住登陆，则记录登录状态，把用户名和加密的密码放到cookie里面  
			setcookie ( "username", $username, time () + 3600  );
			setcookie ( "password", $password, time () + 3600 );
		}
	}
}
var_dump($row,$username,$password,$remember);
?>