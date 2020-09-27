<?php
// 退出登录
function logout() {
	unset($_SESSION['user_info']);
	if (!empty($_COOKIE['username']) || !empty($_COOKIE['password'])) {
		setcookie("username", null, time()-1, "/");
		setcookie("password", null, time()-1, "/");
		header("refresh:0;url=../login.php");
	}
}
logout();

?>