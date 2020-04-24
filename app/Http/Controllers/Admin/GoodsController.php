<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use App\Goods;
use App\Brand;
use App\Cate;
use DB;
use Validator;


class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 搜索
        $goods_name = request()->goods_name;
        $where = [];
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        //展示
        // $pageSize = config('app.pageSize');
        $goods = Goods::select('goods.*','brand.brand_name','category.cate_name')
                        ->leftjoin('category','goods.cate_id','=','category.cate_id')
                        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                        ->where($where)
                        ->get();
                        // ->paginate(2);
                        // dd($goods);
        return view('admin.goods.index',['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 品牌 
        $brand = Brand::all();
        $cate = Cate::all();
        // 分类
        $cate = $this->createTree($cate);
        //添加
        return view('admin.goods.create',['brand'=>$brand,'cate'=>$cate]);
    }
    public function createTree($data,$parent_id=0,$level = 0){
        if(!$data){
            return;
        }
        static $newarray = [];
        foreach ($data as $v){
            if($v->parent_id==$parent_id){
                $v->level = $level;
                $newarray[] = $v;
                $this->createTree($data,$v->cate_id,$level+1);
            }
        }
        return $newarray;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // 表单验证
         $vaildatedData = $request->validate(
            [
            'goods_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:goods',
            'cate_id' => 'required',
            'brand_id' => 'required',
            'goods_num' => 'required|digits_between:1,8',
            'goods_price' => 'required|numeric|between:1,9999999',

            ],[
                'goods_name.regex'=>'商品名称可以包含中文、数字、字母、下划线长度范围为2-50位！',
                'goods_name.unique'=>'商品名称已存在！',
                'cate_id.required'=>'请选择商品分类!',
                'brand_id.required'=>'请选择商品品牌!',
                'goods_price.required'=>'商品价格必填！',
                'goods_price.numeric'=>'商品价格必须是数字！',
                'goods_num.required'=>'商品库存必填！',
                'goods_num.between'=>'商品库存不超过8位！',
                'goods_num.between'=>'商品库存不超过八位！',

            ]
        );


        // 执行商品添加
        $post = $request->except('_token'); 
        // dd($post);
        // 单文件上传
        if($request->hasFile('pic')){
            $post['pic'] =$this->upload('pic');
        }
       // 多文件上传
         if($request->hasFile('pics')){
            $pics =$this->Moreupload('pics');
            $post['pics'] =implode('|', $pics);
        }

        $res = Goods::create($post);
        // dd($res);
        
        if($res){
            return redirect('/goods/index');
        }
    }
    public function upload($filename){
        if (request()->file($filename)->isValid()){
            //接收上传文件
            $file = request()->$filename;
            //实现上传
            $path = $file->store('uploads');
            return $path;
        }
        exit('上传文件出错!');
    }
    public function Moreupload($filename){
        $file = request()->$filename;
        if(!is_array($file)){
            return;
        }
        foreach($file as $k=>$v){
            $path[$k] = $v->store('uploads');
        }
        return $path;
        exit('上传文件出错!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //编辑
         // 品牌 
         $brand = Brand::all();
         $cate = Cate::all();
         // 分类
         $cate = $this->createTree($cate);
         //添加
         return view('admin.goods.create',['brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 表单验证
         // 表单验证
         $vaildatedData = $request->validate(
            [
            // 'goods_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:goods',
            'goods_name' => [
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                Rule::unique('goods')->ignore($id,'goods_id'),
            ],
            'cate_id' => 'required',
            'brand_id' => 'required',
            'goods_num' => 'required|digits_between:1,8',
            'goods_price' => 'required|numeric|between:1,9999999',

            ],[
                'goods_name.regex'=>'商品名称可以包含中文、数字、字母、下划线长度范围为2-50位！',
                'goods_name.unique'=>'商品名称已存在！',
                'cate_id.required'=>'请选择商品分类!',
                'brand_id.required'=>'请选择商品品牌!',
                'goods_price.required'=>'商品价格必填！',
                'goods_price.numeric'=>'商品价格必须是数字！',
                'goods_num.required'=>'商品库存必填！',
                'goods_num.between'=>'商品库存不超过8位！',
                'goods_num.between'=>'商品库存不超过八位！',
            ]
        );
        //执行编辑
        $post = $request->except(['_token']);

        if($request->hasFile('pic')){
            $post['pic'] = $this->upload('pic');
        }
       // 多文件上传
         if($request->hasFile('pics')){
            $pics = $this->Moreupload('pics');
            $post['pics'] =implode('|', $pics);
        }

         $res = Goods::where('goods_id',$id)->update($post);
         if($res !== false){
            return redirect('goods/index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        $res = Goods::destroy($id);
        if($res){
            return redirect('goods/index');
        }
    }

}
