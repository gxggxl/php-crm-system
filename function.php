<?php

include_once "database/conn.php";

/**
 * [userCheck 查询用户是否存在]
 * @param $db
 * @param $tableName
 * @param $post
 * @param $col
 * @return bool   [返回布尔值]
 */
function userCheck($db, $tableName, $post, $col) {
	if (isset($post)) {
		$sql = "SELECT * FROM {$tableName} WHERE {$col}='{$post}'";
		$res = (bool) $db->read_one($sql);
		return $res;
	}
}
// var_dump($db,$tableName,$post,$col);
// $tableName = "crm_users";
// // $user =;
// if(isset($_POST['username'])){
// $valid = userCheck($db,$tableName,$_POST['username'],"username");
// }elseif(isset($_POST['phonenum'])){
// $valid = userCheck($db,$tableName,$_POST['phonenum'],"phonenum");
// }elseif(isset($_POST['email'])){
// $valid = userCheck($db,$tableName,$_POST['email'],"email");
// }

/**
* 检测数字奇偶
* @var $num
* @return BOOL
*/
function checkNum($num){
  return ($num%2) ? true : false;
}

/**
 * [logout 退出登录]
 * [清除COOKIE]
 */

function logout() {
	unset($_SESSION['user_info']);
	if (!empty($_COOKIE['username']) || !empty($_COOKIE['password'])) {
		setcookie("username", null, time()-1, "/");
		setcookie("password", null, time()-1, "/");
		header("refresh:0;url=../login.php");
	}
}

/**
 * [menu 菜单]
 * @return void [输出HTML]
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