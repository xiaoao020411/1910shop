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
    <center><h1>管理员列表</h1></center>
    <a style="float:right;" href="{{url('/admin/create')}}" type="button" class="btn btn-default">添加</a><hr>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>头像</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adminInfo as $k=>$v)
        <tr>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
            <td>{{$v->admin_email}}</td>
            <td>@if($v->header)<img src="{{env('UPLOADS_URL')}}{{$v->header}}" alt="" height="25" width="25">@endif</td>
            <td><a href="{{url('/admin/edit/'.$v->admin_id)}}" type="button" class="btn btn-warning" >编辑</a> |
                <a href="{{url('/admin/destroy/'.$v->admin_id)}}"type="button" class="btn btn-danger">删除</a></td>
        </tr>
        @endforeach
        </tbody>
        <tr><td colspan="8">{{$adminInfo->appends(['adminInfo'=>$adminInfo])->links()}}</td></tr>
    </table>
</body>
</html>

