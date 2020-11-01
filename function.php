<?php

include_once "database/conn.php";

/**
 * [userCheck 查询用户是否存在]
 *
 * @param $db
 * @param $tableName
 * @param $post
 * @param $col
 * @return bool   [返回布尔值]
 */
function userCheck($db, $tableName, $post, $col) {
	if (!isset($post)) {
		return false;
	}

	$sql = "SELECT * FROM {$tableName} WHERE {$col}='{$post}'";
	return (bool)$db->read_one($sql);
}

/**
 * 检测数字奇偶
 *
 * @return BOOL
 * @var $num
 */
function checkNum($num) {
	return (bool)($num%2);
}

/**
 * [logout 退出登录]
 * [清除COOKIE]
 */

function logout() {
	unset($_SESSION['user_info']);
	if (!empty($_COOKIE['username']) || !empty($_COOKIE['password'])) {
		setcookie("username", null, time() - 1, "/");
		setcookie("password", null, time() - 1, "/");
		header("refresh:0;url=../login.php");
	}
}

/**
 * [menu 菜单]
 *
 * @return void [输出HTML]
 */
function menu() {
	if (!isset($_COOKIE['username'])) {
		echo "<li><a href='registered.php'>注册</a></li>";
		echo "<li><a href='login.php'>登录</a></li>";
	} else {
		echo "<li><a href='user.php'>" . $_COOKIE['username'] . "</a></li>";
		echo "<li><a href='tool/logout.php'>注销</a></li>";
	}
}

/**
 * 计算文件大小
 *
 * 在线文件大小换算 https://www.bejson.com/convert/filesize
 *
 * @param $num  [Bytes]
 * @return string
 */
function getFilesize($num) {
	$p = 0;
	$format = 'Bytes';
	if ($num > 0 && $num < 1024) {
		$p = 0;
		return number_format($num) . ' ' . $format;
	}
	if ($num >= 1024 && $num < pow(1024, 2)) {
		$p = 1;
		$format = 'KB';
	}
	if ($num >= pow(1024, 2) && $num < pow(1024, 3)) {
		$p = 2;
		$format = 'MB';
	}
	if ($num >= pow(1024, 3) && $num < pow(1024, 4)) {
		$p = 3;
		$format = 'GB';
	}
	if ($num >= pow(1024, 4) && $num < pow(1024, 5)) {
		$p = 3;
		$format = 'TB';
	}
	$num /= pow(1024, $p);
	return number_format($num, 3) . ' ' . $format;
}

/**
 * 计算文件大小
 *
 * @param $bytes
 * @return string
 */
function formatSizeUnits($bytes) {
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes/1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes/1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes/1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes .= ' Bytes';
	} elseif ($bytes == 1) {
		$bytes .= ' byte';
	} else {
		$bytes = '0 Bytes';
	}

	return $bytes;
}