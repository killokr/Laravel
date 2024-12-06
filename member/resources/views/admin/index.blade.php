<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员管理系统</title>
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
        
        <table border="1" cellspacing="0" cellpadding="10" style="border-collapse: collapse" 
        align="center" width="90%">
            <tr>
                <td>序号</td>
                <td>用户名</td>
                <td>性别</td>
                <td>信箱</td>
                <td>爱好</td>
                <td>是否管理员</td>
                <td>操作</td>
            </tr>
            @foreach($allUser as $info)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$info['username']}}</td>
                <td>{{$info['sex']}}</td>
                <td>{{$info['email']}}</td>
                <td>{{$info['fav']}}</td>
                <td>{{$info['email']}}</td>
                <td>{{$info['admin']?'是':'否'}}</td>
                <td>
                    修改资料 设置管理员 删除会员
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <script>
        function del(id,name){
            if(confirm('您确定要删除会员 ' + name + ' ?')){
                location.href = 'del.php?id=' + id + '&username=' + name;
            }
        }
    </script>
</body>
</html>