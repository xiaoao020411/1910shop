<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
       return view('index',['name'=>'张庆']);
    }
    public function doadd(){
        $post = request()->all();
        dd($post);
    }
    public function goods($goods_id,$name){
        echo '裤子价格：',$goods_id;
        echo '短袖价格:',$name;
    }
    public function good($goods_id){
        echo $goods_id;
        
    }
    public function show($id=0){
        echo $id;
        
    }
    public function detail($id,$name=null){
        echo $id;
        dd($name);
    }
}
