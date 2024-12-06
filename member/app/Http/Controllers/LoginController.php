<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        // dd($request->all());
        // $data = $request->all();
        $data = $request->except('_token');
        $rule = [
            'username' => 'required|alpha_num|between:3,10',
            'pw' => 'required|regex:/^[a-zA-Z0-9_*]{6,10}$/',
            'captcha' => 'required|regex:/^[abcdefghjkmnpqrstuvwxy123456789ABCDEFGHJKMNPQRSTUVWXY]{4}$/'
        ];
        $msg = [
            'username.required' => '用户名必填',
            'username.alpha_num' => '用户名只能由字母和数字构成',
            'username.between' => '用户名长度只能是3-10',
            'pw.required' => '密码必填',
            'pw.regex' => '密码只能由大小写字符、数字、_、*构成',
            'captcha.required' => '验证码必填',
            'captcha.regex' => '验证码填写错误'
        ];
        $validator = Validator::make($data, $rule, $msg);
        if($validator->fails()){ // 输入错误，回上一页，抛售信息
            return redirect('login')->with('errors', $validator->errors())->withInput();
        }else{
            if(strtolower($data['captcha']) == strtolower(Session::get('phrase'))){
                Session::forget('phrase'); // 销毁Session参数：验证码
                // 接下来判断用户名和密码是否正确
                $user = UserModel::where('username',$data['username'])->first();
                if(!$user){
                    $validator->errors()->add('username','用户名不存在');                
                    return redirect('login')->with('errors', $validator->errors())->withInput();
                }
                $user = UserModel::where(['username'=>$data['username'],'pw'=>md5($data['pw'])])->first();
                if(!$user){
                    $validator->errors()->add('pw','密码错误');                
                    return redirect('login')->with('errors', $validator->errors())->withInput();
                }
                else{
                    Session::put('loggedUsername',$data['username']);
                    Session::put('isAdmin',$user->admin);
                    if($user->admin){
                        // 说明是管理员
                        return \redirect('admin');
                        // return view('admin.index')->with(['loggedUsername'=>$data['username'],'isAdmin'=>$user->admin]);
                    }else{
                        return view('index')->with(['loggedUsername'=>$data['username'],'isAdmin'=>$user->admin]);   
                    }
                }
            }else{
                $validator->errors()->add('captcha','验证码错误');
                return redirect('login')->with('errors',$validator->errors())->withInput();
            }
        }
    }
    public function logout(){
        // 清空session
        session()->flush();
        // 退回首页
        return redirect('/login');
    }
}
