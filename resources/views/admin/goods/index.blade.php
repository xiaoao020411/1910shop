<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title></title>
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
		<li class="active"><a href="{{url('/goods/index')}}">商品管理</a></li>
		<li><a href="{{url('/login')}}">管理员</a></li>
      </ul>
    </div>s
  </div>
</nav>
<center><h3><font color='red'>商品列表页</font></h3><a style="float:right;" href="{{url('/goods/create')}}" type="button" class="btn btn-info">添加</a></center>

<form>
	<input type="text" name="goods_name" placeholder="请输入关键字">
	<button>搜索</button>
</form>

<table class="table table-striped">
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品分类</th>
			<th>商品品牌</th>
			<th>价格</th>
			<th>库存</th>
			<th>是否显示</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>商品主图</th>
			<th>商品相册</th>
			<th>商品描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach ($goods as $v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v->is_show}}</td>
			<td>{{$v->is_new}}</td>
			<td>{{$v->is_jing}}</td>
			<td>@if($v->pic)<img src="{{env('UPLOADS_URL')}}{{$v->pic}}" width="35" height="35">@endif</td>

			<td>
				@if($v->pics)
				@php $pics = explode('|',$v->pics);@endphp
				@foreach($pics as $k => $vv)
				<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="35" height="35">
				@endforeach
				@endif
			</td>
			<td>{{$v->goods_desc}}</td>
			<td>
            <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>
            <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
            </td>
		</tr>
        @endforeach
        <tr>
        	</td>
        </tr>
	</tbody>
</table>

</body>
</html>