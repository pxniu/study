<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加用户</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>添加用户</legend>
</fieldset>

<form id="info_form" name="info_form" class="layui-form" method="post" action="/Home/User/add" >

    <div class="layui-form-item">
        <label class="layui-form-label">选择角色</label>
        <div class="layui-input-inline">
            <select id="roleid" name="roleid" lay-verify="required">
                <option value="">请选择角色</option>
                <?php
                if (!empty ($list)) {
                    foreach ($list as $key => $val) {
                ?>
                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="layui-form-mid layui-word-aux">请务必选择部门</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" id="username" placeholder="请输入用户名" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请务必填写用户名</div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">用户类型</label>
        <div class="layui-input-inline">
            <select name="isboss" id="isboss" lay-verify="required" class="layui-select">
                <option value="">请选择用户类型</option>
                <option value="1">超级管理员</option>
                <option value="2">管理员</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" id="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请务必填写密码</div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">再次输入</label>
        <div class="layui-input-inline">
            <input type="password" id="oldPassword" name="oldPassword" lay-verify="oldPassword" placeholder="请再次输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-inline">
                <input type="text" id="nickname" name="nickname" lay-verify="required" placeholder="请填写昵称" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">请务必填写昵称</div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="func" value="1" />
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript" src="/static/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="/static/js/ajaxform.js"></script>
<script type="text/javascript" src="/static/js/jquery-validate.js"></script>
<script>
    layui.use(['form', 'tree', 'layedit', 'laydate'], function() {
        var $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;
    });
    $(function(){
        $('form[name=info_form]').validate({
            errorElement: 'span',
            success:function(label)
            {
                label.addClass('success');
            },
            rules:{
                username:{
                    required:true,
                    remote: {
                        url:"/Home/User/checkAddUser",
                        type:"post",
                        dataType:"json",
                        data:{
                            username:function(){
                                return $("#username").val();
                            }
                        }
                    }
                }
            },
            messages:{
                username:{
                    required:"请输入账号",
                    remote: "账号已存在"
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
        $('#info_form').ajaxForm(function(data){
            if(data.code == 1) {
                parent.layer.closeAll();
                parent.layer.msg("添加成功");
                parent.window.location.reload();
            }else {
                parent.layer.closeAll;
                parent.layer.msg("添加失败");
            }
        });

    });
</script>
</body>
</html>