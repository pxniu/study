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
<body style="background:url('/static/images/loginbg.jpeg') no-repeat;height:100%;width:100%; background-size:100%;display:flex;justify-content: center;align-items: center;">
<div class="video_mask"></div>
<div class="login">
    <h1>系统后台</h1>
    <form id="myform" name="myform" action="/Home/Login/index" method="post">
        <div class="layui-form-item">
            <input class="layui-input" id="username" name="username" placeholder="用户名" type="text" autocomplete="off" value="" >
        </div>
        <div class="layui-form-item">
            <input class="layui-input" name="password" placeholder="密码" type="password" autocomplete="off">
        </div>
        <!--<div class="layui-form-item form_code">
            <input class="layui-input" name="code" placeholder="验证码" lay-verify="required" type="text" autocomplete="off">
            <div class="code"><img src="/static/images/code.jpg" width="116" height="36"></div>
        </div>-->
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">登录</button>
    </form>
</div>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script>
<script type="text/javascript" src="/static/js/ajaxform.js"></script>
<script type="text/javascript" src="/static/js/jquery-validate.js"></script>
<script>
    $(function(){
        $('form[name=myform]').validate({
            errorElement: 'span',
            success:function(label)
            {
                label.addClass('success');
            },
            rules:{
                username:{
                    required:true,
                    remote: {
                        url:"/Home/Login/checkUsername",
                        type:"post",
                        dataType:"json",
                        data:{
                            username:function(){
                                return $("#username").val();
                            }
                        }
                    }
                },
                password:{
                    required:true
                }
            },
            messages:{
                username:{
                    required:"请输入账号",
                    remote: "账号不存在"
                },
                password:{
                    required:"请输入密码"
                }
            },
            showErrors:function(errorMap,errorList) {
                if (errorList.length != 0) {
                    layer.msg(errorList[0].message);
                    return false;
                }
            }
        });

        //验证回调
        $('#myform').ajaxForm(function(data){
            console.info(data);
            if (data.code == 1) {
                layer.msg("登录成功！",{icon: 6,time:2000,end:function(){
                    window.location.href = "/Home/Index/index";
                }});
            } else {
                layer.msg(data.msg,{icon: 6,time:2000,end:function(){

                }});
            }
        });

    });
</script>
</body>
</html>