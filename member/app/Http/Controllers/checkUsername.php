<?php

namespace App\Http\Controllers;

use App\Models\UserModel;

use Illuminate\Http\Request;

class checkUsername extends Controller
{
    public function checkUsername(Request $request){
        // Ajax下
        // post提交 419令牌问题
        // get提交 500未知问题
        // 暂时空置
        // dd($request);
        // $data = $request->except('_token');
        // $user = UserModel::where('username',$data('username'))->get();
        // if($user){
            // return true;
        // }
        $username = $_GET['username'];
        // $user = UserModel::where('username',$data('username'))->get();
        $a = array(); // 创建空数组
        if(empty($username)){ // 如果用户名为空
            $a['code'] = 1; // 自定义返回消息的代码code，1表示用户名为空
            $a['msg'] = '用户名不能为空';
        }
        else{
            $conn = mysqli_connect("localhost","root","root","member",3306);
            if(!$conn){
                die("连接数据库服务器失败");
            }
            mysqli_query($conn,"set names utf8");
            $sql = "select 1 from info where username = '$username'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                //找到了此用户名，则说明此用户名不可用
                $a['code'] = 0; // 0表示用户名已存在
                $a['msg'] = '此用户名不可用';
            }
            else{
                $a['code'] = 2; // 2表示用户名可用
                $a['msg'] = '此用户名可用';
            }
        }
        // return response()->json(array('msg')=>$a),200);
        // echo json_encode($a);
        // return json_encode($a);
    }
}
