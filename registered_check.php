<?php
// 引入数据库操作文件
include "conn.php";

$username = $_POST["username"];
$email = $_POST["email"];
$age = $_POST["age"];
$phonenum = $_POST["phonenum"];
$pwd = $_POST["pwd"];
$pwd1 = $_POST["pwd1"];
// Y ：年（四位数）大写 
// m : 月（两位数，首位不足补0） 小写 
// d ：日（两位数，首位不足补0） 小写 
// H：小时 带有首位零的 24 小时小时格式 
// h ：小时 带有首位零的 12 小时小时格式 
// i ：带有首位零的分钟 
// s ：带有首位零的秒（00 -59） 
// a：小写的午前和午后（am 或 pm）
// $time = date('Y-m-s H:i:s',time());
$createtime = time();

$password = md5($pwd);

if(isset($_POST['username'])){
	$sql = "SELECT * FROM crm_users WHERE username='{$_POST['username']}'";
	//查到数据返回false，bool取反；
	$res = (bool) $db->read_one($sql);
	if($res){
		echo "用户名已注册";
		exit;
	}
}

if(isset($_POST['email'])){
	$sql = "SELECT * FROM crm_users WHERE email='{$_POST['email']}'";
	$res = (bool) $db->read_one($sql);
	if($res){
		echo "邮箱已注册";
		exit;
	}
}


	if($pwd==$pwd1){
		$sql = "INSERT INTO `crm_users`(`username`, `password`, `email`, `age`, `phonenum`, `createtime`) VALUES ('{$username}','{$password}','{$email}','{$age}','{$phonenum}','{$createtime}')";
		$res = $db->write($sql);
		$id=$db->insert_id();
		echo "注册成功，你的ID为".$id;
		var_dump($res);
	}
	else{
		echo "注册失败";
	}



?>