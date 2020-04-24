<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');

        $adminInfo = Admin::paginate($pageSize);

        return view('admin.admin.index', ['adminInfo'=>$adminInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        if( $data['admin_pwd'] != $data['confirm_pwd'] ){
            return redirect('/admin/create');
        }

       

        $data['admin_pwd'] = encrypt($data['admin_pwd']);

        

        if( $request->hasFile('header') ){
            $data['header'] = $this->upload('header');
        }
        unset($data['confirm_pwd']);
        $res = Admin::create($data);

        if($res){
            return redirect('/admin');
        }

    }
    public function upload($filename){
        if (request()->file($filename)->isValid()){
            //接收上传文件
            $file = request()->$filename;
            //实现上传
            $path = $file->store('upload');
            return $path;
        }
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
        $info = Admin::where('admin_id', $id)->first();

        return view('admin.admin.edit', ['info'=>$info]);
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
        $data = $request->except('_token');

        if( $data['admin_pwd'] != $data['confirm_pwd'] ){
            return redirect('/admin/edit/'.$id);
        }

        if( $request->hasFile('header') ){
            $data['header'] = $this->upload('header');
        }

        $data['admin_pwd'] = encrypt($data['admin_pwd']);

        $data['confirm_pwd'] = encrypt($data['confirm_pwd']);

        $res = Admin::where('admin_id', $id)->update($data);

        if($res != false){
            return redirect('/admin');
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
        $res = Admin::destroy($id);

        if($res){
            return redirect('/admin');
        }
    }

    public function checkOnly(){

        $admin_name = \request()->admin_name??'';

        $count = Admin::where(['admin_name'=>$admin_name])->count();

        echo json_encode(['code'=>'00000', 'msg'=>'ok', 'count'=>$count]);
    }
}
