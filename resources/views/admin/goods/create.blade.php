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
		<li class="active"><a href="{{url('/goods/index')}}">商品管理</a></li>
		<li><a href="{{url('/login')}}">管理员</a></li>
      </ul>
    </div>s
  </div>
</nav>
<center><h3><font color='red'>商品添加页</font></h3><a style="float:right;" href="{{url('/goods/index')}}" type="button" class="btn btn-info">列表</a></center>

<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif -->

<form class="form-horizontal" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data"
>
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="goods_name"
				   placeholder="请输入商品名称">
				   <b style="color: red">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-8">
			<select name="cate_id">
				<option value="">--请选择--</option>
				@foreach($cate as $v)
				<option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
				   <b style="color: red">{{$errors->first('cate_id')}}</b>

		</div>
	</div>
 <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-8">
			<select name="brand_id">
				<option value="">--请选择--</option>
				@foreach ($brand as $v)
				<option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
				@endforeach
			</select>
				   <b style="color: red">{{$errors->first('brand_id')}}</b>

		</div>
	</div>

<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="goods_price"
				   placeholder="请输入商品价格">
				   <b style="color: red">{{$errors->first('goods_price')}}</b>


		</div>
	</div>

<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="goods_num"
				   placeholder="请输入商品库存">
				   <b style="color: red">{{$errors->first('goods_num')}}</b>

		</div>
</div>

<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
			<input type="radio" name="is_show" checked value="是">是
			<input type="radio" name="is_show" value="否">否
		</div>
</div>

<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-8">
			<input type="radio" name="is_new" checked value="是">是
			<input type="radio" name="is_new" value="否">否
		</div>
</div>

<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
			<input type="radio" name="is_jing" checked value="是">是
			<input type="radio" name="is_jing" value="否">否
		</div>
</div>

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" id="firstname" name="pic">
		</div>
	</div>
	 <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" id="firstname" multiple name="pics[]">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌介绍</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="goods_desc"
				   placeholder="请输入品牌介绍"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>