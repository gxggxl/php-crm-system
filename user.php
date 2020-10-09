<?php
include_once "head.php";
include_once "database/conn.php";
include_once "page/page.class.php";

// 验证登录状态
if (empty($_COOKIE['username']) && empty($_COOKIE['password'])) {
	exit("<script>alert('你没有登录！请登录。');window.location='login.php';</script>");
}
?>

<div class="container-fluid">
	<div class="row">
	<div class="col-md-2">
		<div class="well well-sm">
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
		<div class="well well-sm table-responsive">
<?php
$sql2 = "select * from crm_users";
$db->read_all($sql2);
//获取行数
$total = $db->rows;

$pageSize=isset($_GET['size'])?$_GET['size']:10;
// var_dump($total);

$page = new Page($total,$pageSize);
$limit=$page->limit();
$sql1 = "select * from crm_users limit {$limit}";
$rows = $db->read_all($sql1);
// var_dump($limit,$page ,$sql1);

/**
* 数字检测奇偶
* @var $num The number to check
* @return BOOL
*/
function checkNum($num){
  return ($num%2) ? true : false;
}
echo '<table class="table table-hover table-bordered table-condensed table-responsive text-nowrap">';
echo '<caption><h1 class="text-center">Users</h1></caption>';
echo '<thead><tr>
		<th scope="row">uid</th>
		<th scope="row">username</th>
		<th scope="row">sex</th>
		<th scope="row">email</th>
		<th scope="row">phonenum</th>
		<th scope="row">createtime</th>
		</tr></thead>';
echo '<tbody>';
for($i=0; $i <count($rows) ; $i++){
	//表格隔行加了点颜色
	if(checkNum($i)===false){
		echo '<tr class="success">';
		}else{
			echo '<tr>';
	}
	echo '<td>'.$rows[$i]["uid"].'</td>';
	echo '<td>'.$rows[$i]["username"].'</td>';
	echo '<td>'.$rows[$i]["sex"].'</td>';
	echo '<td>'.$rows[$i]["email"].'</td>';
	echo '<td>'.$rows[$i]["phonenum"].'</td>';
	echo '<td>'.$rows[$i]["createtime"].'</td>';
	echo '</tr>';
}
echo '<tr><td colspan="6" align="right">'.$page->showPage().'</td></tr>';
echo '</tbody>';
echo '</table>';

// var_dump(count($rows,0));
// echo "<pre>";
// print_r($rows);
// echo "</pre>";
?>
		</div>
	</div>

	<div class="col-md-2">
		<div class="well well-sm">
<?php
$sql = "SELECT * FROM crm_users WHERE username='{$_COOKIE['username']}'";
$res = $db->read_one($sql);
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

<?php include_once 'footer.php';?>