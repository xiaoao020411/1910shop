<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center><h2>管理员添加</h2></center>
<b style="color:red">{{session('msg')}}</b>
<form action="{{url('/logindo')}}" method="post" class="form-horizontal" role="form">
	@csrf
    <div class="form-group">
		<label for="firstname" class="col-sm-5 control-label">名字</label>
		<div class="col-sm-3">
			<input type="text" name="admin_name" class="form-control" id="firstname" 
				   placeholder="请输入用户名">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-5 control-label">姓</label>
		<div class="col-sm-3">
			<input type="password" name="admin_pwd" class="form-control" id="lastname" 
				   placeholder="请输入密码">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-5 col-sm-10">
        <button type="submit" class="btn btn-primary btn-lg">登陆</button>
		</div>
	</div>
</form>

</body>
</html>s