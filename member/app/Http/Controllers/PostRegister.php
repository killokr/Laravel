<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class PostRegister extends Controller
{
    public function index(Request $request){
        // 请求前端数据
        $data = $request->except('_token');
        // 验证前端数据
        $rule = [
            'username'=>'required|alpha_num|between:3,10',
            'pw'=>'required|regex:/^[a-zA-Z0-9_*]{6,10}$/',
            'email'=>'nullable|email',
            'cpw'=>'required|same:pw',
            'fav'=>'nullable'
        ];
        $msg = [
            'username.required'=>'用户名必填',
            'username.alpha_num'=>'用户名只能由大小写字符和数字组成',
            'username.between'=>'用户名长度只能是3~10个字符',
            'pw.required'=>'密码必填',
            'pw.regex'=>'密码只能由大小写字符和_、*构成',
            'cpw.required'=>'确认密码必须填写',
            'cpw.same'=>'确认密码和密码必须相同',
            'email.email'=>'信箱格式错误'
        ];
        $validator = \Validator::make($data,$rule,$msg);
        if($validator->fails()){
            // 验证失败
            return redirect('/register')->with('errors',$validator->errors())->withInput();
        }
        $result = UserModel::where('username',$data['username'])->first();
        if($result){
            $validator->errors()->add('username','此用户名已被使用');
            return redirect('/register')->with('errors',$validator->errors())->withInput();
        }
        $email = $data['email'] ?? '';
        $fav = isset($data['fav']) ? implode(',',$data['fav']) : '';
        $info = array('username'=>$data['username'],
        'pw'=>md5($data['pw']),
        'email'=>$email,
        'sex'=>$data['sex'],
        'fav'=>$fav,
        'createTime'=>time()
        );
        $result = UserModel::insert($info);
        if($result){
            echo "<script>alert('注册成功');location='/login';</script>";
        }else{
            echo "<script>alert('注册失败');history.back();</script>";
        }
    }
    
}
