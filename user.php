<?php
include_once "head.php";
include_once "database/conn.php";

$sql = "SELECT * FROM crm_users WHERE username='{$_COOKIE['username']}'";
$res = $db->read_one($sql);
// 验证登录状态
if (empty($_COOKIE ['username']) && empty( $_COOKIE ['password'] )) {
	exit("<script>alert('你没有登录！请登录。');window.location='login.php';</script>");
}
?>
<!-- <ul class="nav nav-pills nav-stacked">
  <li role="presentation" id="bar-1"><a href="bar-1">Bar 1</a></li>
  <li role="presentation" id="bar-2"><a href="bar-2">Bar 2</a></li>
  <li role="presentation" id="bar-3"><a href="bar-3">Bar 3</a></li>
</ul>
 -->
<div class="container-fluid">
	<div class="row">
	<div class="col-md-2">
		<div class="well">
			<ul class="nav nav-pills nav-stacked">
			  <li role="presentation" id="bar-1"><a href="bar-1">Bar 1</a></li>
			  <li role="presentation" id="bar-2">
			    <a href="#docCollapse" class="nav-header collapsed" data-toggle="collapse" id="collapseParent" onclick="chevron_toggle()">Bar 2<span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
			    <ul id="docCollapse" class="nav nav-list collapse">
			      <li><a href="#">Child Bar 1</a></li>
			      <li><a href="#">Child Bar 2</a></li>
			    </ul>
			  </li>
			  <li role="presentation" id="bar-3"><a href="bar-3">Bar 3</a></li>
			</ul>
		</div>
	</div>
	<div class="col-md-8">
		<div class="well">
			<?php
			var_dump($res);
			echo "uid:".$res['uid']."<br>";
			echo "用户名:".$res['username']."<br>";
			echo "性别:".$res['sex']."<br>";
			echo "邮箱:".$res['email']."<br>";
			echo "手机:".$res['phonenum']."<br>";
			?>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur distinctio porro dolorum animi blanditiis neque mollitia odit maiores possimus perspiciatis aperiam at molestias earum ipsum atque necessitatibus est ex sit?</div>
	</div>
	
	<div class="col-md-2">
		<div class="well">
			<?php
			var_dump($res);
			echo "uid:".$res['uid']."<br>";
			echo "用户名:".$res['username']."<br>";
			echo "性别:".$res['sex']."<br>";
			echo "邮箱:".$res['email']."<br>";
			echo "手机:".$res['phonenum']."<br>";
			?>
		</div>
	</div>
	</div>
</div>


<script>
	function chevron_toggle(){
	    $("#collapseParent").find("span").toggleClass("glyphicon-chevron-up");
	    $("#collapseParent").find("span").toggleClass("glyphicon-chevron-down");
	}
</script>

<?php include_once 'footer.php'; ?>