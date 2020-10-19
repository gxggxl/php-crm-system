<?php
/**
 * @author   ：gxggxl
 * @BlogURL  : https://gxusb.com
 * @DateTime : 2020/10/11 18:29
 * @FilePath : test.php
 */
// 引入数据库操作文件
include_once dirname(__FILE__) . "/database/conn.php";

$pass = md5(md5("123456") . "gx");
// string(32) "e0ba03690d506d5a6c03ba1228ea5ca5"
var_dump($pass);

$pas = md5("123456");
// string(32) "e10adc3949ba59abbe56e057f20f883e"
var_dump($pas);

//获取用户IP地址
print_r('<pre>用户IP地址：' . $_SERVER['SERVER_ADDR'] . '</pre>');
//获取用户UA
print_r('<pre>用户UA：' . $_SERVER['HTTP_USER_AGENT'] . '</pre>');
//var_dump($_SERVER);

var_dump(__DIR__);//文件路径

// Y ：年（四位数）大写
// m : 月（两位数，首位不足补0） 小写
// d ：日（两位数，首位不足补0） 小写
// H：小时 带有首位零的 24 小时小时格式
// h ：小时 带有首位零的 12 小时小时格式
// i ：带有首位零的分钟
// s ：带有首位零的秒（00 -59）
// a：小写的午前和午后（am 或 pm）

//$time = date('Y-m-d H:i:s', time());
//// int(1600849580)
//var_dump($time);

//$str = "  Hello World!";
//var_dump($str . "<br>");
////删除左侧空格
//var_dump(trim($str));

