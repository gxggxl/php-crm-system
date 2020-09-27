<?php
/**
 * [menu 菜单]
 * @return [html] [输出HTML]
 */
function menu() {
	if (!isset($_COOKIE['username'])) {
		echo "<li><a href='registered.php'>注册</a></li>";
		echo "<li><a href='login.php'>登录</a></li>";
	} else {
		echo "<li><a href='user.php'>".$_COOKIE['username']."</a></li>";
		echo "<li><a href='tool/logout.php'>注销</a></li>";
	}
}