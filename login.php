<?php include './head.php'; ?>
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

		<style>
			.input-group {
			margin: 10px 0px;
			/* 输入框上下外边距为10px,左右为0px */
		}

		h3 {
			padding: 5px;
			border-bottom: 1px solid #ddd;
			/*h3字体下边框*/
		}

		.info-a>li {
			list-style-type: square;
			/*列表项图标为小正方形*/
			margin: 10px 0;
			/*上下外边距是10px*/
		}

		em {
			/*强调的样式*/
			color: #c7254e;
			font-style: inherit;
			background-color: #f9f2f4;
		}
	</style>
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
					<div class="well col-md-12">
						<h3>用户登录</h3>
						<div class="input-group input-group-md">
							<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
							<input type="text" class="form-control" placeholder="用户名" aria-describedby="sizing-addon1">
						</div>
						<div class="input-group input-group-md">
							<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" class="form-control" placeholder="密码" aria-describedby="sizing-addon1">
						</div>
						<div class="well well-sm" style="text-align:center;">
							<input type="radio" name="kind" value="tea"> 老师
							<input type="radio" name="kind" value="stu"> 学生
						</div>
						<button type="submit" class="btn btn-success btn-block">
							登录
						</button>
					</div>
				</div>
				<div class="col-md-6">
					<h3>
						欢迎使用学生作业管理系统
					</h3>
					<ul class="info-a">
						<li>学生使用<em>学号</em>登录，初始密码为<em>6个1</em>，登录后请及时修改密码</li>
						<li>老师请使用<em>工号</em>登录，初始密码为<em>6个1</em>，登录后请及时修改密码</li>
					</ul>
				</div>
			</div>
		</div>
		
<?php include './footer.php'; ?>