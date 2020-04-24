<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class LoginController extends Controller
{
  public function logindo(Request $request){
      $admin = $request->except('_token');
      
      $adminuser = Admin::where('admin_name',$admin['admin_name'])->first();
      
      if(decrypt($adminuser->admin_pwd)!=$admin['admin_pwd']){
          return redirect('/login')->with('msg','用户名或者密码不对！');
      }
      session(['adminuser'=>$adminuser]);
      return redirect('/brand');
  }
}
