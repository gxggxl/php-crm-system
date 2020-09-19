<?php include 'head.php'; ?>
<link rel="stylesheet" href="./css/bootstrapvalidator-0.5.3/css/bootstrapValidator.css">
<script type="text/javascript" src="./css/bootstrapvalidator-0.5.3/js/bootstrapValidator.js"></script>
<div class="caption">
	<div class="well well-sm col-xs-10 col-xs-offset-1">
			<h3 class="text-center">用户注册</h3>
			<form action="./registered.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">用户名</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="username" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">姓名</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="name" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">年龄</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="age" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">电话</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="phoneNumber" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">手机</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="phoneNumber1" data-bv-notempty="true" data-bv-notempty-message="用户名不能为空" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Email</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="email" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">密码</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="pwd" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">确认密码</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="pwd1" />
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
								remote: { //后台验证，比如查询用户名是否存在
									url: 'student/verifyUsername',
									message: '此用户名已存在'
								}
							}
						},
						name: {
							message: '姓名验证失败',
							validators: {
								notEmpty: {
									message: '姓名不能为空'
								}
							}
						},
						age: {
							message: '年龄验证失败',
							validators: {
								notEmpty: {
									message: '年龄不能为空'
								},
								numeric: {
									message: '请填写数字'
								}
							}
						},
						phoneNumber: {
							message: '电话号验证失败',
							validators: {
								notEmpty: {
									message: '电话号不能为空'
								},
								regexp: { //正则验证
									regexp: /^1\d{10}$/,
									message: '请输入正确的电话号'
								}
							}
						},
						phoneNumber1: {
							message: '电话号验证失败',
							validators: {
								notEmpty: {
									message: '电话号不能为空'
								},
								regexp: { //正则验证
									regexp: /^1\d{10}$/,
									message: '请输入正确的电话号'
								}
							}
						},
						email: {
							message: 'Email验证失败',
							validators: {
								notEmpty: {
									message: 'Email不能为空'
								},
								emailAddress: { //验证email地址
									message: '不是正确的email地址'
								}
							}
						},
						pwd: {
							notEmpty: {
								message: '密码不能为空'
							},
							stringLength: { //检测长度
								min: 4,
								max: 15,
								message: '用户名需要在4~15个字符'
							}
						},
						pwd1: {
							message: '密码验证失败',
							validators: {
								notEmpty: {
									message: '密码不能为空'
								},
								identical: { //与指定控件内容比较是否相同，比如两次密码不一致
									field: 'pwd', //指定控件name
									message: '两次密码不一致'
								}
							}
						}
					}
				});

				$("#btn").click(function() { //非submit按钮点击后进行验证，如果是submit则无需此句直接验证
					$("form").bootstrapValidator('validate'); //提交验证
					if ($("form").data('bootstrapValidator').isValid()) { //获取验证结果，如果成功，执行下面代码
						alert("yes"); //验证成功后的操作，如ajax
					}
				});
			})
		</script>
		<!-- 下面是几个比较常见的验证规则。
		notEmpty：非空验证；
		stringLength：字符串长度验证；
		regexp：正则表达式验证；
		emailAddress：邮箱地址验证（都不用我们去写邮箱的正则了~~）
		base64：64位编码验证；
		between：验证输入值必须在某一个范围值以内，比如大于10小于100；
		creditCard：身份证验证；
		date：日期验证；
		ip：IP地址验证；
		numeric：数值验证；
		url：url验证；
		callback：自定义验证
		Form表单的提交 -->
		
<?php include 'footer.php'; ?>