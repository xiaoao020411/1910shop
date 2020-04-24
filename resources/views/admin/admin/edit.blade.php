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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="{{url('/brand')}}">商品品牌</a></li>
        <li><a href="{{url('/cate')}}">商品分类</a></li>
		<li><a href="{{url('/goods')}}">商品管理</a></li>
		<li class="active"><a href="{{url('/admin')}}">管理员</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h1>修改管理员</h1></center>
<a style="float:right;" href="{{url('/admin')}}" type="button" class="btn btn-default">列表</a><hr>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal" role="form" action="{{url('/admin/update/'.$info->admin_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="admin_name" value="{{$info->admin_name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="admin_pwd">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="confirm_pwd">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-8">
            <input type="tel" class="form-control" name="admin_tel" value="{{$info->admin_tel}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" name="admin_email" value="{{$info->admin_email}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="" name="header" value="{{$info->admin_header}}">
            @if($info->header)<img src="{{env('UPLOAD_URL')}}{{$info->header}}" alt="" height="25" width="25">@endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>

</body>
</html>
<script>
    jquery = $;
    
    $(function () {
        $(document).on('blur', '#s_name', function () {

        })
    })
</script>
