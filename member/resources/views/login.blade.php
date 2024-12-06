<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员注册管理系统</title>
    <style>
        .main { width: 80%; margin: 0 auto; text-align: center; }
        h2 { font-size: 20px }
        h2 a { color: navy; text-decoration: none; margin-right: 15px }
        h2 a:last-child { margin-right: 0 }
        h2 a:hover { color: brown; text-decoration: underline; }
    </style>
</head>

<body>
    <div class="main">
        @include('nav')
        <form action="{{url('userLogin')}}" method="post" onsubmit="return check()">
            @csrf 
            <table align="center" border="1" style="border-collapse:collapse;" cellpadding="10">
                <tr>
                    <td align="right">用户名</td>
                    <td align="left"><input type="text" name="username" value="{{old('username')}}"><span style="color:red;">*</span>
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
                    <td align="right">验证码</td>
                    <td align="left">
                        <input name="captcha" placeholder="请输入图片中的验证码" value="{{old('captcha')}}">
                        <img style="cursor:pointer" src="{{url('/captchaShow')}}" onclick="this.src='{{url('/captchaShow')}}?'+new Date().getTime();" width="200" height="70">
                        <span style="color:red;">*</span>
                        @if($errors->has('captcha'))
                            @php
                                $e = $errors->getMessages();
                                $msg = implode(';',$e['captcha']);
                            @endphp
                            <span style="color:red;">{{$msg}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td align="right"><input type="submit" value="提交"></td>
                    <td align="left"><input type="reset" value="重置"></td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        function check(){
            let username = document.getElementsByName('username')[0].value.trim();
            let pw = document.getElementsByName('pw')[0].value.trim();
            // 用户名验证（非空、限字验证）
            let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
            if(!usernameReg.test(username)){
                alert('用户名必填，且只能由大小写字符和数字构成，长度为3到10个字符');
                return false;
            }
            let pwreg = /^[a-zA-Z0-9_*]{6,10}$/;
            if(!pwreg.test(pw)){
                alert('密码必填，且只能由大小写字符和数字,符号*及_构成，长度为6到10个字符');
                return false;
            }
            let code = document.getElementsByName('code')[0].value.trim();
            let codeReg = /^[a-zA-Z0-9]{4}$/;
            if(!codeReg.test(code)){
                alert('错误验证码！');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>