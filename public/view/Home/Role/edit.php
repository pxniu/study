<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加角色</title>
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
    <legend>系统角色管理修改</legend>
</fieldset>
<form id="myForm" name="myForm" class="layui-form layui-form-pane" action="/Home/Role/edit" method="post" >
    <div class="layui-form-item">
        <label class="layui-form-label">角色名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" id="name" value="<?=$info['name']?>" lay-verify="required" autocomplete="off" placeholder="请输入角色名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block">
            <input type="text" name="remark" id="remark" value="<?=$info['remark']?>" lay-verify="required" autocomplete="off" placeholder="请输入备注" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色授权</label>
        <div class="layui-input-block">
            <div id="menuTree" class="ztree" >
            </div>
            <input id="menuIds" name="menuIds" type="hidden">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="id" value="<?=$info['id']?>" />
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<link href="/static/jquery-ztree/3.5.12/css/zTreeStyle/zTreeStyle.min.css" rel="stylesheet" type="text/css"/>
<script src="/static/jquery-ztree/3.5.12/js/jquery.ztree.all-3.5.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/js/ajaxform.js"></script>
<script type="text/javascript">
    var myBoolean = new Boolean();
    layui.use('form', function(){var $ = layui.jquery;

        var setting = {check:{enable:true,nocheckInherit:true},view:{selectedMulti:false},
            data:{simpleData:{enable:true}},callback:{beforeClick:function(id, node){
                tree.checkNode(node, !node.checked, true, true);
                return false;
            }}};

        var treeJson;

        var form = layui.form;
        //自定义验证规则
        form.verify({
            roleName: function(value){
                if(!checkInput(value)) {
                    return "输入含有特殊字符，请重试！";
                }
            },
            roleCode: function(value){
                if(!checkInput(value)) {
                    return "输入含有特殊字符，请重试！";
                }
            }
            ,remark:function(value){
                if(!checkInput(value)) {
                    return "输入含有特殊字符，请重试！";
                }
            }
        });

        $.ajax({
            type : "post",
            url : "/Home/Role/getTree",
            data : {},
            dataType : "json",
            async : false,
            success : function(data) {
                treeJson= data.data;
            }
        });
        // 用户-菜单
        var zNodes=treeJson;
        // 初始化树结构
        var tree = $.fn.zTree.init($("#menuTree"), setting, zNodes);
        // 不选择父节点
        tree.setting.check.chkboxType = { "Y" : "ps", "N" : "s" };
        // 默认选择节点
        var ids = "<?php echo $menuIds; ?>".split(",");
        for(var i=0; i<ids.length; i++) {
            var node = tree.getNodeByParam("id", ids[i]);
            try{tree.checkNode(node, true, false);}catch(e){}
        }
        // 默认展开全部节点
        tree.expandAll(true);

        form.on('submit', function (data) {
            var ids = [], nodes = tree.getCheckedNodes(true);
            for(var i=0; i<nodes.length; i++) {
                ids.push(nodes[i].id);
            }
            if(ids=="" || ids ==null || ids =="undefined") {
                layer.alert("请选择权限！");
                return false;
            }
            $("#menuIds").val(ids);
            $("#myForm").ajaxForm(function(e){
                if(e.code == 1) {
                    layer.msg("添加成功！",{icon: 6,time:2000,end:function(){
                        parent.layer.closeAll();
                        parent.window.location.reload();
                    }});
                } else {
                    layer.msg("添加失败！",{icon: 5,time:2000,end:function(){
                        parent.layer.closeAll();
                        parent.window.location.reload();
                    }});
                }
            });
        });
    });

    $("#closeAll").bind("click", function(){
        parent.layer.closeAll();
    });
</script>
</body>
</html>
