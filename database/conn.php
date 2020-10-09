<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-22 15:32:24
 * @LastEditTime : 2020-09-27 20:26:32
 * @FilePath     : /php-crm-system/database/conn.php
 */

// 引入配置文件
include_once "config.php";
// 引入数据库操作类
include_once "mysqli.class.php";
// 实例化数据库操作对象，并引入配置信息
$db = new Sql($dbinfo);
