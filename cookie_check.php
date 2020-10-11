<?php

/**
 * 登陆判断
 * 一般发在头文件进行登陆判断
 */
function cookieCheck()
{
    if (!isset($_COOKIE['username'])) {
        //window写法(标准)
        // echo "<script>alert('当前用户未登录！');window.location='login.php'</script>";
        //header写法
        header("refresh:1;url=login.php");
        //refresh 多少秒后唤醒
        exit("<script>alert('当前用户未登录！')</script>");
    }
}
