<?php
// 检查用户是否登录
function checkLogin() {
	if (empty($_SESSION['user_info'])) {
		// 检查一下session是不是为空
		if (empty($_COOKIE['username']) || empty($_COOKIE['password'])) {
			header("location:login.php?req_url=".$_SERVER['REQUEST_URI']);
			// 转到登录页面，记录请求的url，登录后跳转过去，用户体验好。
		} else {
			$user = getUserInfo($_COOKIE['username'], $_COOKIE['password']);
			// 去取用户的个人资料
			if (empty($user)) {
				header("location:login.php?req_url=".$_SERVER['REQUEST_URI']);
			} else {
				$_SESSION['user_info'] = $user;
				// 用户名和密码对了，把用户的个人资料放到session里面
			}
		}
	}
}
checkLogin();
?>
