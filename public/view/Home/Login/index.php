<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/static/css/login.css" media="all" />
</head>
<body style="background:url('/static/images/loginbg.jpeg') no-repeat; background-size:100%;">
<div class="video_mask"></div>
<div class="login" style="height: auto;width: 350px" >
    <h1>系统后台</h1>
    <form class="layui-form" id="myform" name="myform" action="/home/login/logindo" method="post"  >
        <div class="layui-form-item">
            <input class="layui-input" id="username" name="username" placeholder="用户名" lay-verify="required" type="text" autocomplete="off" value="" >
        </div>
        <div class="layui-form-item">
            <input class="layui-input" name="password" placeholder="密码" lay-verify="required" type="password" autocomplete="off">
        </div>
        <!--<div class="layui-form-item form_code">
            <input class="layui-input" name="code" placeholder="验证码" lay-verify="required" type="text" autocomplete="off">
            <div class="code"><img src="/static/images/code.jpg" width="116" height="36"></div>
        </div>-->
        <input type="submit" value="登录" class="layui-btn login_btn">
    </form>
</div>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script>

<script>

</script>
</body>
</html>