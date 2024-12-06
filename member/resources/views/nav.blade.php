<style>
    .current {
        color: brown
    }

    h2{
        text-align: center;
    }

    .logged {
        font-size: 16px;
        color: darkgreen
    }

    .logout {
        margin-left: 20px;
        margin-bottom: 15px;
    }

    .logout a {
        color: cornflowerblue;
        text-decoration: none
    }

    .logout a:hover {
        text-decoration: underline
    }
</style>
<h1>会员注册管理系统</h1>
@if(isset($loggedUsername))
<div class="logged">
    当前登录者：{{$loggedUsername}}
    @if($isAdmin) 
        <span style="color:crimson;">欢迎管理员登录</span>
    @endif
    <span class="logout"><a href="{{url('/logout')}}">退出登录</a></span>
@endif
</div>
<!-- blade模板引擎 -->
@php
    if(!isset($id)){
        $id = $_GET['id'] ?? 1;
    }
@endphp
<h2>
    <a href="{{url('/')}}?id=1" <?php if($id == 1){?>class="current"<?php }?>>首页</a>
    <a href="{{url('register')}}?id=2" <?php if($id == 2){?>class="current"<?php }?>>会员注册</a>
    <a href="{{url('/login')}}?id=3" <?php if($id == 3){?>class="current"<?php }?>>会员登录</a>
    <a href="modify.php?id=4&source=member" <?php if($id == 4){?>class="current"<?php }?>>个人资料修改</a>
    <a href="{{url('admin')}}?id=5" <?php if($id == 5){?>class="current"<?php }?>>后台管理</a>
</h2>
