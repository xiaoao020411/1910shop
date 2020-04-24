<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 悬停表格</title>
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
<center><h2>分类管理</h2><a style="float:right;" href="{{url('/cate/create')}}" type="button" class="btn btn-info">添加</a></center>
<table class="table table-hover">
	
	<thead>
		<tr>
            <th>分类ID</th>
			<th>分类名称</th>
			<th>是否显示</th>
            <th>是否在导航栏显示</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach($cate as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
            <td>{{$v->is_show}}</td>
            <td>{{$v->is_nav_show}}</td>
            <td><a href="{{url('/cate/destroy/'.$v->cate_id)}}" type="button" class="btn btn-danger">删除</a>  | 
			<a href="{{url('/cate/edit/')}}" type="button" class="btn btn-warning">编辑</a></td>
		</tr>
	@endforeach
	</tbody>
</table>

</body>
</html>