<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-22 14:01:49
 * @LastEditTime : 2020-09-23 15:24:21
 * @FilePath     : /php-crm-system/user_check.php
 */

// 引入数据库操作
include "database/conn.php";
header('Content-type: application/json');
// Bootstrapvalidator 用户后端实时检查
$valid = true;//用户名可用
// 查询用户是否存在
$username = $_POST['username'];
if (isset($username)) {
	$sql = "SELECT * FROM crm_users WHERE username='{$_POST['username']}'";
	//查到数据返回false，bool取反；
	$valid = !(bool) $db->readOne($sql);
	// var_dump($valid);
	// $valid = false;
}
if (isset($_POST['email'])) {
	$sql   = "SELECT * FROM crm_users WHERE email='{$_POST['email']}'";
	$valid = !(bool) $db->readOne($sql);
}
if (isset($_POST['phonenum'])) {
	$sql   = "SELECT * FROM crm_users WHERE phonenum='{$_POST['phonenum']}'";
	$valid = !(bool) $db->readOne($sql);
}

echo json_encode(
	array('valid' => $valid)
);
