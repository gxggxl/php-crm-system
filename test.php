<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-10-11 18:29:50
 * @LastEditTime : 2020-11-07 21:28:13
 * @FilePath     : /php-crm-system/test.php
 */
/**
 * @author   ：gxggxl
 * @BlogURL  : https://gxusb.com
 * @DateTime : 2020/10/11 18:29
 * @FilePath : test.php
 */
// 引入数据库操作文件
include_once __DIR__ . "/database/conn.php";

$pass = md5(md5("123456") . "gx");
// string(32) "e0ba03690d506d5a6c03ba1228ea5ca5"
//var_dump($pass);

$pas = md5("123456");
// string(32) "e10adc3949ba59abbe56e057f20f883e"
//var_dump($pas);

//获取用户IP地址
echo '<pre>用户IP地址：' . $_SERVER['SERVER_ADDR'] . '</pre>';
//获取用户UA
echo '<pre>用户UA：' . $_SERVER['HTTP_USER_AGENT'] . '</pre>';
//var_dump($_SERVER);
//echo '脚本文件路径：' . __DIR__ . '<br>';

// Y ：年（四位数）大写
// m : 月（两位数，首位不足补0） 小写
// d ：日（两位数，首位不足补0） 小写
// H：小时 带有首位零的 24 小时小时格式
// h ：小时 带有首位零的 12 小时小时格式
// i ：带有首位零的分钟
// s ：带有首位零的秒（00 -59）
// a：小写的午前和午后（am 或 pm）

echo '服务器时间：' . date('Y-m-d H:i:s', time()) . '<br>';
// int(1600849580)
//var_dump($time);

//$str = "  Hello World!";
//var_dump($str . "<br>");
////删除左侧空格
//var_dump(trim($str));

//判断内容页是否百度收录

function baiduRecord() {
	$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	if (checkBaidu($url) == 1) {
		echo "百度已收录";
	} else {
		echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录！\" target=\"_blank\" href=\"https://zhanzhang.baidu.com/sitesubmit/index?sitename=$url\">百度未收录</a>";
	}
}

function checkBaidu($url) {
	$url = 'http://www.baidu.com/s?wd=' . urlencode($url);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$rs = curl_exec($curl);
	curl_close($curl);
	//查没有找到 说明百度没有收录
	if (strpos($rs, '没有找到')) {
		return -1;
	} else {
		return 1;
	}
}

//echo baiduRecord();

$sql = 'SELECT * FROM yourtable WHERE 查询条件 ORDER BY id DESC LIMIT 0,10';


?>

