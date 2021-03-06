<?php
include __DIR__ . "/head.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/database/conn.php";
include_once "page/page.class.php";

// 验证登录状态
if (empty($_COOKIE['username']) && empty($_COOKIE['password'])) {
	exit("<script>alert('你没有登录！请登录。');window.location='login.php';</script>");
}
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation" id="bar-1"><a href="">Bar 1</a></li>
                        <li role="presentation" id="bar-2">
                            <a href="#docCollapse" class="nav-header collapsed" data-toggle="collapse"
                               id="collapseParent" onclick="chevron_toggle()">Bar 2<span
                                        class="pull-right glyphicon glyphicon-chevron-down"></span></a>
                            <ul id="docCollapse" class="nav nav-list collapse">
                                <li><a href="#">Child Bar 1</a></li>
                                <li><a href="#">Child Bar 2</a></li>
                            </ul>
                        </li>
                        <li role="presentation" id="bar-3"><a href="">Bar 3</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default table-responsive">
					<?php
					$sql2 = "SELECT * FROM crm_users";
					$db->readAll($sql2);
					//获取行数
					$total = $db->rows;

					$pageSize = $_GET['size'] ?? 10;
					// var_dump($total);

					$page = new Page($total, $pageSize);
					$limit = $page->limit();
					$sql1 = "SELECT * FROM crm_users LIMIT {$limit}";
					$rows = $db->readAll($sql1);
					// var_dump($limit,$page ,$sql1);

					/**
					 * 检测数字奇偶
					 * @return BOOL
					 * @var $num
					 */
					function checkNum($num) {
						return (bool)($num % 2);
					}

					echo '<table class="table table-hover table-condensed table-responsive text-nowrap">
                          <caption><h1 class="text-center">Users</h1></caption>
                          <thead><tr>
		                  <th scope="row">用户ID</th>
		                  <th scope="row">用户名</th>
		                  <th scope="row">性别</th>
		                  <th scope="row">E-mail</th>
		                  <th scope="row">手机号码</th>
		                  <th scope="row">注册时间</th>
		                  <th scope="row">注册IP地址</th>
		                  </tr></thead>
                          <tbody>';
					for ($i = 0, $iMax = count($rows); $i < $iMax; $i++) {
						//表格隔行加了点颜色
						if (checkNum($i) === false) {
							echo '<tr class="success">';
						} else {
							echo '<tr>';
						}
						echo '<td>' . $rows[$i]["uid"] . '</td>';
						echo '<td>' . $rows[$i]["username"] . '</td>';
						echo '<td>' . $rows[$i]["sex"] . '</td>';
						echo '<td>' . $rows[$i]["email"] . '</td>';
						echo '<td>' . $rows[$i]["phone_num"] . '</td>';
						echo '<td>' . date('Y年m月d日 H:i:s', $rows[$i]["create_time"]) . '</td>';
						echo '<td>' . $rows[$i]["ip"] . '</td>';
						echo '</tr>';
					}
					echo '<tr><td style="text-align: right" colspan="7">' . $page->showPage() . '</td></tr>';
					echo '</tbody>
                          </table>';

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
					$res = $db->readOne($sql);
					echo "uid:" . $res['uid'] . "<br>";
					echo "用户名:" . $res['username'] . "<br>";
					echo "性别:" . $res['sex'] . "<br>";
					echo "邮箱:" . $res['email'] . "<br>";
					echo "手机:" . $res['phone_num'] . "<br>";
					?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function chevron_toggle() {
            $("#collapseParent").find("span").toggleClass("glyphicon-chevron-up").find("span")
                .toggleClass("glyphicon-chevron-down");
        }
    </script>

<?php include_once 'footer.php'; ?>