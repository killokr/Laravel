<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页</title>
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
    </div>
</body>

</html>