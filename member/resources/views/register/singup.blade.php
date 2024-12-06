<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>会员管理系统</title>
    <style>
        .main {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            font-size: 20px
        }

        h2 a {
            color: navy;
            text-decoration: none;
            margin-right: 15px
        }

        h2 a:last-child {
            margin-right: 0
        }

        h2 a:hover {
            color: brown;
            text-decoration: underline;
        }

        .current {
            color: brown;
        }
        .green {
            color: green
        }
        .black {
            color: black
        }
        #loading {
            width: 50px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="main">
        @include('nav')
        <form action="{{url('postRegister')}}" method="post" onsubmit="return check()">
            @csrf
            <table align="center" border="1" style="border-collapse:collapse;" cellpadding="10" cellspacing="0">
                <tr>
                    <td align="right">用户名</td>
                    <td align="left">
                    <!-- onblur="checkUsername()" -->
                        <input type="text" name="username" value="{{old('username')}}">
                        <span style="color:red;">*</span>
                        <img src="img/loading.gif" id="loading">
                        <span id="usernameMsg"></span>
                        @if($errors->has('username'))
                            @php
                                $e = $errors->getMessages();
                                $msg = implode(';',$e['username']);
                            @endphp
                            <span style="color:red;">{{$msg}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td align="right">密码</td>
                    <td align="left"><input type="password" name="pw"><span style="color:red;">*</span>
                    @if($errors->has('pw'))
                        @php
                            $e = $errors->getMessages();
                            $msg = implode(';',$e['pw']);
                        @endphp
                        <span style="color:red;">{{$msg}}</span>
                    @endif
                </td>
                </tr>
                <tr>
                    <td align="right">确认密码</td>
                    <td align="left"><input type="password" name="cpw"><span style="color:red;">*</span>
                    @if($errors->has('cpw'))
                        @php
                            $e = $errors->getMessages();
                            $msg = implode(';',$e['cpw']);
                        @endphp
                        <span class="red">{{$msg}}</span>
                    @endif
                </td>
                </tr>
                <tr>
                    <td align="right">性别</td>
                    <td align="left">
                        <input type="radio" name="sex" checked value="1">男
                        <input type="radio" name="sex" value="0">女
                    </td>
                </tr>
                <tr>
                    <td align="right">邮箱</td>
                    <td align="left"><input type="text" name="email" value="{{old('email')}}">
                    @if($errors->has('email'))
                        @php
                            $e = $errors->getMessages();
                            $msg = implode(';',$e['email']);
                        @endphp
                        <span class="red">{{$msg}}</span>
                    @endif
                </td>
                </tr>
                <tr>
                    <td align="right">爱好</td>
                    <td align="left">
                        <input type="checkbox" name="fav[]" value="听音乐">听音乐
                        <input type="checkbox" name="fav[]" value="玩游戏">玩游戏
                        <input type="checkbox" name="fav[]" value="踢足球">踢足球
                    </td>
                </tr>
                <tr>
                    <td align="right"><input type="submit" value="提交"></td>
                    <td align="left"><input type="reset" value="重置"></td>
                </tr>
            </table>
        </form>
    </div>
    <script src="{{url('/jquery-3.3.1.min.js')}}"></script>
    <script>
        function checkUsername() {
            let username = document.getElementsByName('username')[0].value.trim();
            let usernameReg = /^[a-zA-Z0-9]{3,10}$/; // 验证用户名的正则表达式
            if (username.length > 0) { // 如果用户填写了用户名
                if (!usernameReg.test(username)) { // 如果填写的用户名不符合规范（不符合正则表达式）
                    alert('用户名必填，且只能由大小写字符和数字构成，长度为3到10个字符！');
                    $("#usernameMsg").text('');
                    document.getElementsByName('username')[0].value = '';
                    document.getElementsByName('username')[0].focus();
                    return false;
                }
                // 令牌
                // $.ajaxSetup({
                //     headers: {
                //         'X-CRSF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // 使用JQuery中的ajax()方法
                $.ajax({
                    url: "{{url('checkUsername')}}", // ajax请求的地址
                    type: 'get', // 请求方式
                    dataType: 'json', // 预期的服务器响应的数据类型
                    data: {username: username}, // 要发送到服务器的数据
                    beforeSend:function (){ // 发送请求前运行的函数
                        $("#usernameMsg").text('');
                        $("#loading").show();
                    },
                    success: function (data) { // 当请求成功时运行的函数
                        $("#loading").hide();
                        if (data.code == 0) {
                            //表明不可用
                            $("#usernameMsg").text(data.msg).removeClass('black').addClass('green');
                        } else if (data.code == 2) {
                            //表明可用
                            $("#usernameMsg").text(data.msg).removeClass('green').addClass('black');
                        }
                    },
                    error: function () { // 如果请求失败要运行的函数
                        $("#loading").hide();
                        alert('网络错误');
                    }
                })
            }
        }
        function check(){
            let username = document.getElementsByName('username')[0].value.trim();
            let pw = document.getElementsByName('pw')[0].value.trim();
            let cpw = document.getElementsByName('cpw')[0].value.trim();
            let email = document.getElementsByName('email')[0].value.trim();
            //用户名验证
            let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
            if(!usernameReg.test(username)){
                alert('用户名必填，且只能由大小写字符和数字构成，长度为3到10个字符！');
                return false;
            }
            let pwreg = /^[a-zA-Z0-9_*]{6,10}$/;
            if(!pwreg.test(pw)){
                alert('密码必填，且只能大小写字符和数字，以及*、_构成，长度为6到10个字符！');
                return false;
            }
            else{
                if(pw!=cpw){
                    alert('密码和确认密码必须相同！')
                    return false;
                }
            }
            let emailReg = /^[a-zA-Z0-9_\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
            if(email.length > 0 ){
                if(!emailReg.test(email)){
                    alert('邮箱格式不正确！')
                    return  false;
                }
            }
            return true;
        }
    </script>
</body>
</html>