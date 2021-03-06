<?php include_once 'head.php';
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-02 23:29:11
 * @FilePath     : /php-crm-system/login.php
 */
?>
    <div class="container login">
        <div class="row">
            <div class="col-md-6" style="border-right:1px solid #ddd;">
                <form action="login_check.php" method="post">
                    <div class="well col-md-12">
                        <h3 class="login-title">用户登录</h3>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"
                                                                                  aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="用户名"
                                   aria-describedby="sizing-addon1">
                        </div>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="密码"
                                   aria-describedby="sizing-addon1">
                        </div>
                        <!-- <div class="input-group input-group-md">
                            <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-exclamation-sign"></i></span>
                            <input type="text" class="form-control" name="vcode" placeholder="验证码" aria-describedby="sizing-addon1">
                        </div> -->
                        <div class="well-sm text-center">
                            <input type="checkbox"  name="remember" value="1">
                            <span class="checkbox-password">记住密码</span>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">登录</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h3>欢迎使用客户管理系统</h3>
                    <ul class="info-a">
                        <li>管理员使用<em>admin</em>登录，初始密码为<em>123456</em>，登录后请及时修改密码</li>
                        <li>客户请使用<em>user</em>登录，初始密码为<em>123456</em>，登录后请及时修改密码</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>