<?php include 'head.php'; ?>
<?php
 //    $conn = mysqli_connect('localhost','root','','test') or die('数据库连接失败');
 //    $conn->query("SET NAMES 'UTF8'");
 
 //    $user = $_POST['username'];
 //    $pass = $_POST['password'];
 //    $sql="SELECT * FROM users where username='{$user}' and password='{$pass}'"; 
 
 //    $result=$conn->query($sql);
 //    $row = mysqli_num_rows($result);
	// //若表中存在输入的用户名和密码，row=1；若表中用户名不存在或密码错误，则row=0
 
 //    if($row == 1){
 //        echo $row['username']."登陆成功!";
 //    }
 //    else{
 //        echo"登录失败，请重新登录！";
 //    }	
?>	

		<script type="text/javascript">
			$(function() {
				$('#btn').click(function(e) {
					window.location.href = "./login.php";
				});
			});
		</script>

		<div class="container">
			<div class="row">
				<div class="col-md-6" style="border-right:1px solid #ddd;">
					<div class="login well col-md-12">
						<h3 class="login-title">用户登录</h3>
						<div class="input-group input-group-md">
							<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="uesrname" placeholder="用户名" aria-describedby="sizing-addon1">
						</div>
						<div class="input-group input-group-md">
							<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" class="form-control" name="password" placeholder="密码" aria-describedby="sizing-addon1">
						</div>
						<!-- <div class="well well-sm" style="text-align:center;">
							<input type="radio" name="kind" value="tea"> 管理员
							<input type="radio" name="kind" value="stu"> 客户
						</div> -->
						<button type="submit" class="btn btn-success btn-block">登录</button>
					</div>
				</div>
				<div class="col-md-6">
					<h3>
						欢迎使用客户管理系统
					</h3>
					<ul class="info-a">
						<li>管理员使用<em>admin</em>登录，初始密码为<em>123456</em>，登录后请及时修改密码</li>
						<li>客户请使用<em>user</em>登录，初始密码为<em>123456</em>，登录后请及时修改密码</li>
					</ul>
				</div>
			</div>
		</div>
		
<?php include 'footer.php'; ?>