<?php include 'head.php';?>
<div class="container registered">
			<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<div class="panel">
				<h3 class="text-center">用户注册</h3>
				<form action="registered_check.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="username" class="col-md-3 control-label">用户名</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="username" name="username" />
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-md-3 control-label">E-mail</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="email" name="email" />
						</div>
					</div>
					<div class="form-group">
						<label for="sex" class="col-md-3 control-label">性别</label>
						<div class="col-md-6">
							<input type="radio" class="form-inline" id="sex" name="sex" value="男"/> &nbsp;男
							<input type="radio" class="form-inline" id="sex" name="sex" value="女"/> &nbsp;女
							<input type="radio" class="form-inline" id="sex" name="sex" value="保密" checked="checked"/> &nbsp;保密
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-md-3 control-label">手机</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="phone" name="phone_num" />
						</div>
					</div>
					<div class="form-group">
						<label for="pwd" class="col-md-3 control-label">密码</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="pwd" name="pwd" />
						</div>
					</div>
					<div class="form-group">
						<label for="pwd1" class="col-md-3 control-label">确认密码</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="pwd1" name="pwd1" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button id="btn" type="submit" class="btn btn-primary btn-block active">提交</button>
						</div>
					</div>
				</form>
			</div>
			</div>
			</div>
		</div>
		<script type="text/javascript">
			$(function() {
				$('form').bootstrapValidator({
					//默认提示
					message: 'This value is not valid',
					// 表单框里右侧的icon
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					submitHandler: function(validator, form, submitButton) {
						// 表单提交成功时会调用此方法
						// validator: 表单验证实例对象
						// form jq对象 指定表单对象
						// submitButton jq对象 指定提交按钮的对象
					},
					fields: {
						username: {
							message: '用户名验证失败',
							validators: {
								notEmpty: { //不能为空
									message: '用户名不能为空'
								},
								stringLength: { //检测长度
									min: 4,
									message: '用户名不能小于4个字符'
								},
								remote: {
									//后台验证，询用户名是否存在
									type: 'POST',
									url: 'user_check.php',
									message: '此用户名已存在',
									delay: 1000
								}
							}
						},
						sex: {
							message: '请选择性别',
							validators: {
								notEmpty: {
									message: '请选择性别'
								}
								// numeric: {
								// 	message: '请填写数字'
								// }
							}
						},
						phone_num: {
							message: '电话号验证失败',
							validators: {
								notEmpty: {
									message: '电话号不能为空'
								},
								regexp: { //正则验证
									regexp: /^1\d{10}$/,
									message: '请输入正确的电话号'
								},
								remote: {
									//后台验证，询用户名是否存在
									type: 'POST',
									url: 'user_check.php',
									message: '此手机号码已注册',
									delay: 1000
								}
							}
						},
						email: {
							message: 'Email验证失败',
							validators: {
								notEmpty: {
									message: 'Email不能为空'
								},
								emailAddress: {
									//验证email地址
									message: '不是正确的email地址'
								},
								remote: {
									type: 'POST',
									url: 'user_check.php',
									message: '此邮箱已经注册',
									delay: 2000
								}
							}
						},
						pwd: {
							message: '密码验证失败',
							validators: {
								notEmpty: {
									message: '密码不能为空'
								},
								stringLength: { //检测长度
									min: 6,
									message: '密码小于6个字符'
								},
							}
						},
						pwd1: {
							message: '密码验证失败',
							validators: {
								notEmpty: {
									message: '密码不能为空'
								},
								stringLength: { //检测长度
									min: 6,
									message: '密码小于在6个字符'
								},
								identical: { //与指定控件内容比较是否相同，比如两次密码不一致
									field: 'pwd', //指定控件name
									message: '两次密码不一致'
								}
							}
						}
					}
				});

				// $("#btn").click(function() { //非submit按钮点击后进行验证，如果是submit则无需此句直接验证
				// 	$("form").bootstrapValidator('validate'); //提交验证
				// 	if ($("form").data('bootstrapValidator').isValid()) { //获取验证结果，如果成功，执行下面代码
				// 		alert("yes"); //验证成功后的操作，如ajax
				// 	}
				// });
			})
		</script>

<?php include 'footer.php';?>
