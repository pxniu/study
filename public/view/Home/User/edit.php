<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>修改用户</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>修改用户</legend>
</fieldset>

<form id="myForm" class="layui-form" method="post" action="/admin/user/save" >

    <div class="layui-form-item">
        <label class="layui-form-label">选择角色</label>
        <div class="layui-input-inline">
            <select id="roleid" name="roleid" lay-verify="required">
                <option value="">请选择角色</option>
                <?php
                if (!empty ($list)) {
                    foreach ($list as $key => $val) {
                ?>
                        <option <?php if ($info['roleid'] == $val['id']) { echo "selected"; } ?> value="<?=$val['id']?>"><?=$val['name']?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="layui-form-mid layui-word-aux">请务必选择角色</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" id="username" value="<?=$info['username']?>" lay-verify="title" autocomplete="off" placeholder="请输入用户名" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请务必填写用户名</div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">用户类型</label>
        <div class="layui-input-inline">
            <select name="isboss" id="isboss" lay-verify="required" class="layui-select">
                <option value="">请选择用户类型</option>
                <option <?php echo $info['isboss'] == 1 ? "selected" : ""; ?> value="1">超级管理员</option>
                <option <?php echo $info['isboss'] == 2 ? "selected" : ""; ?> value="2">管理员</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" id="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
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
                <input type="text" id="nickname" name="nickname" value="<?=$info['nickname']?>" lay-verify="required" placeholder="请填写昵称" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">请务必填写昵称</div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="func" value="1" />
            <input type="hidden" name="id" value="<?=$info['id']?>" />
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript" src="/static/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="/static/js/ajaxform.js"></script>
<script>
    layui.use(['form', 'tree', 'layedit', 'laydate'], function(){

        var myBoolean1=new Boolean();
        var $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit
            ,laydate = layui.laydate;
        var treeJson;
        $.ajax({
            type : "post",
            url : "/admin/user/getTree",
            data : {},
            dataType : "json",
            async: false,
            success : function(data) {
                treeJson= data.data;
            }
        });

        layui.tree({
            elem: '#menuTree' //指定元素
            ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
            ,click: function(item){ //点击节点回调
                // layer.msg('当前节名称：'+ item.name + '<br>全部参数：'+ JSON.stringify(item));
                $("#pid").val(item.id)
                $("#pName").val(item.name)
                console.log(item);
            }
            ,nodes: treeJson
        });
        //生成一个模拟树
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 2 || value.length > 32){
                    return '用户名必须不小于2且不大于32位';
                } else {
                    $.ajax({
                        type:"post",
                        url:"/admin/user/checkUserAdd",
                        data:{"usercode": value},
                        dataType:"json",
                        success:function(data) {
                            if (data.status) {
                                return "用户名已存在";
                            }
                        }
                    });
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,oldPassword: function(value) {
                if(value != $("#password").val()){
                    $("#oldPassword").val("");
                    return '确认密码与密码不一致';
                }
            }
            ,content: function(value){
                layedit.sync(editIndex);
            }
            ,ucode: function(value) {
                if (value.length < 2 || value.length > 32) {
                    return "唯一编码必须不小于2且不大于32位";
                } else {
                    $.ajax({
                        type:"post",
                        url:"/admin/user/checkAddUcode",
                        data:{"ucode": value},
                        dataType:"json",
                        success:function(data) {
                            if (data.status) {
                                return "用户名已存在";
                            }
                        }
                    });
                }
            }
        });

        form.on("submit", function(data){
            if(myBoolean1){
                layer.msg("您所填写的用户名称已存在，请重新填写！！");
                return false;
            }
            $("#myForm").ajaxForm(function(e){
                if(e.status) {
                    /* parent.layer.closeAll();
                     parent.layer.msg("添加成功");
                     parent.window.location.reload();*/
                    layer.msg("添加成功！",{icon: 6,time:2000,end:function(){
                        parent.layer.closeAll();
                        parent.window.location.reload();
                    }})
                }
            });
        });


        //客户编号唯一性校验
        $("#ucode").blur(function () {
            var ucode = $("#ucode").val();
            if(ucode.trim()!=''){
                $.ajax({
                    type : "post",
                    url : "/admin/user/checkAddUcode",
                    data : {
                        ucode:ucode
                    },
                    dataType : "json",
                    async : false,
                    success : function(data) {
                        if(data.status){
                            layer.msg("您所填写的客户经理唯一编号已存在，请重新填写！！");
                            myBoolean = true;
                        }else{
                            myBoolean = false;
                        }
                    },
                    error : function() {
                        layer.msg("系统异常，请联系管理员");
                    }
                })
            }
        })

        //用户编号唯一性校验
        $("#usercode").blur(function () {
            var usercode = $("#usercode").val();
            if(usercode.trim()!=''){
                $.ajax({
                    type : "post",
                    url : "/admin/user/checkUsercode",
                    data : {
                        usercode:usercode
                    },
                    dataType : "json",
                    async : false,
                    success : function(data) {
                        if(data.status){
                            layer.msg("您所填写的用户名称已存在，请重新填写！！");
                            myBoolean1 = true;
                        }else{
                            myBoolean1 = false;
                        }
                    },
                    error : function() {
                        layer.msg("系统异常，请联系管理员");
                    }
                })
            }
        })
    });

    $("#closeAll").bind("click", function(){
        parent.layer.closeAll();
    });


    layui.use('upload', function(){
        var upload = layui.upload;

        //执行实例
        var uploadInst = upload.render({
            elem: '#myFile' //绑定元素
            ,url: '/admin/user/upload' //上传接口
            ,done: function(res){
                //上传完毕回调
                console.log(res.data);
                if (res.status) {
                    $("#LAY_demo_upload").attr("src", res.data.src);
                    $("#imgid").val(res.data.id);
                    $("#imgname").val(res.data.name);
                    $("#imgsrc").val(res.data.src);
                }
            }
            ,error: function(){
                //请求异常回调
            }
        });
    });
</script>
</body>
</html>