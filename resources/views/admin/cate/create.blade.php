<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>网络电子商城-品牌管理</title>
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
        <li class="active"><a href="{{url('/cate')}}">商品分类</a></li>
		<li><a href="{{url('/goods')}}">商品管理</a></li>
		<li><a href="{{url('/admin')}}">管理员</a></li>
      </ul>
    </div>
  </div>
</nav>
<a style="float:right;" href="{{url('/cate')}}" type="button" class="btn btn-default">列表</a>
<center><h2>分类管理</h2></center>
<form action="{{url('/cate/store')}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父级分类</label>
		<div class="col-sm-10">
		<select class="form-control" name="parent_id">
      <option>选择父级分类</option>
			@foreach($cate as $v)
      <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
      @endforeach
    </select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" id="lastname" value="1" checked>显示
			<input type="radio" name="is_show" id="lastname" value="2">不显示
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航栏显示</label>
		<div class="col-sm-10">
		<input type="radio" name="is_nav_show" id="lastname" value="1" checked>显示
			<input type="radio" name="is_nav_show" id="lastname" value="2">不显示
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>