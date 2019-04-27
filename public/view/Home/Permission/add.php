<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新增菜单</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="http://at.alicdn.com/t/font_tnyc012u2rlwstt9.css" media="all" />
    <link rel="stylesheet" href="/static/css/main.css" media="all" />
</head>
<body class="childrenBody">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>系统菜单管理-新增</legend>
</fieldset>
<form id="myForm" class="layui-form layui-form-pane" action="/home/Permission/add" method="post" >
    <div class="layui-form-item">
        <label class="layui-form-label">菜单名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" id="name" lay-verify="required" autocomplete="off" placeholder="请输入菜单名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">父菜单</label>
        <div class="layui-input-block">
            <input type="text" name="parentName" id ="parentName" autocomplete="off" value="<?=$parentName?>"  class="layui-input" disabled="" >
            <input type="hidden" name="pid" id ="pid"  value="<?php echo $pid; ?>"   >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选择节点</label>
        <div class="layui-input-block" id="menuTree">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单链接</label>
        <div class="layui-input-block">
            <input type="text" name="url" lay-verify="title" autocomplete="off" placeholder="请输入菜单URL" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item" pane="">
        <label class="layui-form-label">菜单图标<br/>
            当前图标<i class="layui-icon"></i></label>
        <div class="layui-input-block">
            <i class="layui-icon">&#xe614;</i><input type="radio" name="icon" title="设置" value="&#xe614;">
            <i class="layui-icon">&#xe60a;</i><input type="radio" name="icon" title="list" value="&#xe60a;">
            <i class="layui-icon">&#xe62c;</i><input type="radio" name="icon" title="图表" value="&#xe62c;">
            <i class="layui-icon">&#xe629;</i><input type="radio" name="icon" title="报表" value="&#xe629;">
            <i class="layui-icon">&#xe620;</i><input type="radio" name="icon" title="设置" value="&#xe620;">
            <i class="layui-icon">&#xe621;</i><input type="radio" name="icon" title="文件" value="&#xe621;">
            <i class="layui-icon">&#xe632;</i><input type="radio" name="icon" title="布局" value="&#xe632;">
            <i class="layui-icon">&#xe638;</i><input type="radio" name="icon" title="窗口" value="&#xe638;">
            <i class="layui-icon">&#xe63c;</i><input type="radio" name="icon" title="表单" value="&#xe63c;">
            <i class="layui-icon">&#xe62a;</i><input type="radio" name="icon" title="tab" value="&#xe62a;">
            <i class="layui-icon">&#xe654;</i><input type="radio" name="icon" title="新增" value="&#xe654;">
            <i class="layui-icon">&#xe642;</i><input type="radio" name="icon" title="编辑" value="&#xe642;">
            <i class="layui-icon">&#xe640;</i><input type="radio" name="icon" title="删除" value="&#xe640;">
            <i class="layui-icon">&#xe615;</i><input type="radio" name="icon" title="搜索" value="&#xe615;">
            <i class="layui-icon">&#xe60e;</i><input type="radio" name="icon" title="记录" value="&#xe60e;">
            <i class="layui-icon">&#xe631;</i><input type="radio" name="icon" title="工具" value="&#xe631;">
            <i class="layui-icon">&#xe612;</i><input type="radio" name="icon" title="用户" value="&#xe612;">
            <i class="layui-icon">&#xe613;</i><input type="radio" name="icon" title="角色" value="&#xe613;">
            <i class="layui-icon">&#xe62d;</i><input type="radio" name="icon" title="菜单" value="&#xe62d;">
            <i class="layui-icon">&#xe622;</i><input type="radio" name="icon" title="文件夹" value="&#xe622;">
            <i class="layui-icon">&#xe658;</i><input type="radio" name="icon" title="星星" value="&#xe658;">
            <i class="layui-icon">&#xe600;</i><input type="radio" name="icon" title="star" value="&#xe600;">
            <i class="layui-icon">&#xe634;</i><input type="radio" name="icon" title="标签" value="&#xe634;">

        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">是否显示</label>
        <div class="layui-input-inline">
            <select name="isshow" lay-verify="required">
                <option value="1">是</option>
                <option value="2">否</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input type="text" name="sort" lay-verify="required|number" autocomplete="off" class="layui-input" value="10" >
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script>
<script type="text/javascript" src="/static/js/ajaxform.js"></script>

<script>
    //Demo
    layui.use(['form', 'tree', 'layer'], function(){
        var layer = layui.layer
            ,$ = layui.jquery;
        var form = layui.form;
        var treeJson;

        // $("#closeAll").bind("click", function(){
        //     parent.layer.closeAll();
        // });


        form.on('submit', function (data) {
            $("#myForm").ajaxForm(function(e){
                if(e.code == 1) {
                    /*parent.layer.closeAll();
                     parent.layer.msg("添加成功");
                     parent.window.location.reload();*/
                    layer.msg("添加成功！",{icon: 6,time:2000,end:function(){
                        parent.layer.closeAll();
                        //parent.window.location.reload();
                    }});
                }
            });
        });

        $.ajax({
            type : "post",
            url : "/Home/Permission/getTree",
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
                $("#parentName").val(item.name)
                console.log(item);
            }
            ,nodes: treeJson
        });
        //生成一个模拟树
    });


</script>

</body>
</html>