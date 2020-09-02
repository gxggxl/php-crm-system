<meta charset="utf-8">
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-07-30 10:32:13
 * @LastEditTime : 2020-09-02 23:05:24
 * @FilePath     : /php-crm-system/login.php
 */
<?php include './head.php'; ?>
<?php
    $conn = mysqli_connect('localhost','root','','test') or die('数据库连接失败');
    $conn->query("SET NAMES 'UTF8'");
 
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $sql="SELECT * FROM users where username='{$user}' and password='{$pass}'"; 
 
    $result=$conn->query($sql);
    $row = mysqli_num_rows($result);
	//若表中存在输入的用户名和密码，row=1；若表中用户名不存在或密码错误，则row=0
 
    if($row == 1){
        echo $row['username']."登陆成功!";
    }
    else{
        echo"登录失败，请重新登录！";
    }	
?>	
