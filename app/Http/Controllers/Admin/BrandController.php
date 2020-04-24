<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name = request()->brand_name;
        $where = [];
        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }


        $pageSize = config('app.pageSize');
        $brand = Brand::orderBy('Brand_id','desc')->where($where)->paginate($pageSize);
        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
    // public function store(StoreBrandPost $request)
    // {
        public function store(Request $request)
    {
        //第一种验证
        // $request->validate([
        //     'brand_name' =>'required|unique:brand|max:20',
        //     'brand_url' =>'required',
        // ],[
        //     'brand_name.required'=>'品牌名称必填！',
        //     'brand_name.unique'=>'品牌名称已存在！',
        //     'brand_name.max'=>'品牌名称最大长度为20位！',
        //     'brand_url.required'=>'品牌网址必填！',
        // ]);
        //获取所有值
        //$post = $request->all();
        //$post = request()->all();
        //$post = request()->input();
         //获取一个值
        //$brand_name=request()->brand_name;
        //dd($brand_name);
        //只接受...
        //$post = request()->only(['_token','brand_logo']);
        //排除接收...
        $post = request()->except(['_token']);


        //第三种验证
        $validator = Validator::make($post, [ 
            'brand_name' =>'required|unique:brand|max:20',
            'brand_url' =>'required',
        ],[
                    'brand_name.required'=>'品牌名称必填！',
                    'brand_name.unique'=>'品牌名称已存在！',
                    'brand_name.max'=>'品牌名称最大长度为20位！',
                    'brand_url.required'=>'品牌网址必填！',
                ]);
        if ($validator->fails()) {
            return redirect('brand/create')
            ->withErrors($validator) 
            ->withInput(); 
        }


        //dump($post);
        //dd($request->hasFile('brand_logo'));
        //接收post过来的值
        //$post = request()->post();
        //文件上传
        if ($request->hasFile('brand_logo')){
            $post['brand_logo'] = $this->upload('brand_logo');
        }
        //ORM操作
        // $brand = new Brand;
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        // if(isset($post['brand_logo'])){
        //     $brand->brand_logo = $post['brand_logo'];
        // }
        // $brand->brand_desc = $post['brand_desc'];
        // $res = $brand->save();
        //$res = Brand::create($post);
        $res = Brand::insert($post);
        if($res){
            return redirect('/brand');
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
    /**
     * Display the specified resource.
     *预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据id获取当前记录
        $brand = Brand::find($id);
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except(['_token']);
        //dump($post);
        //dd($request->hasFile('brand_logo'));
        if (request()->hasFile('brand_logo')){
            $post['brand_logo'] = $this->upload('brand_logo');
        }
        //   $brand = Brand::find($id);
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        // if(isset($post['brand_logo'])){
        //     $brand->brand_logo = $post['brand_logo'];
        // }
        // $brand->brand_desc = $post['brand_desc'];
        // $res = $brand->save();
        //dd($res);
        $res = Brand::where('brand_id',$id)->update($post);
        if($res!==false){
            return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除图片
        $brand_logo = DB::table('brand')->where('brand_id',$id)->value('brand_logo');
        //dd($brand_logo);
        if($brand_logo){
            unlink(storage_path('app/'.$brand_logo));
        }
        // $res = DB::table('brand')->where('brand_id',$id)->delete ();
        $res = Brand::destroy($id);
        if($res){
            return redirect('/brand');
        }
    }
}
