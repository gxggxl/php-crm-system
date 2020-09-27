<?php
include_once "../conn.php";
$username = trim($_POST['username']);
$password = md5(trim($_POST['password']));
$remember = $_POST['remember'];
// $validatecode = $_POST ['validateCode'];
// $ref_url = $_GET ['req_url'];
$err_msg = '';
// if ($validatecode != $_SESSION ['checksum']) {
// 	$err_msg = "验证码不正确";
// } else
$sql = "SELECT username FROM crm_users WHERE username = '{$username}' AND password = '{$password}'";
if ($username == '' || $password == '') {
	$err_msg = "用户名和密码都不能为空";
} else {
	$row = $db->read_one($sql);
	if (empty($row)) {
		$err_msg = "用户名和密码都不正确";
	} else {
		$_SESSION['user_info'] = $row;
		if (!empty($remember)) {
			// 如果记住登陆，则记录登录状态，把用户名和加密的密码放到cookie里面
			setcookie("username", $username, time()+3600);
			setcookie("password", $password, time()+3600);
		}
		// if (strpos ( $ref_url, "login.php" ) === false) {
		// 	header ( "location:" . $ref_url );
		// } else {
		// 	header ( "location:main_user.php" );
		// }
	}
}
?>