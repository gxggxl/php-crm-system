<?php

include_once "database/conn.php";

/**
 * [userCheck 查询用户是否存在]
 * @param  [object] $db        [数据库对象]
 * @param  [string] $tableName [数据库表名]
 * @param  [string] $post      [表单值]
 * @param  [string] $col       [查询字段]
 * @return [boolean]           [返回布尔值]
 */
function userCheck($db, $tableName, $post, $col) {
	if (isset($post)) {
		$sql = "SELECT * FROM {$tablename} WHERE {$col}='{$post}'";
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
