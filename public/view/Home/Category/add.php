<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加分类</title>
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
    <legend>商品分类添加</legend>
</fieldset>
<form id="myForm" class="layui-form layui-form-pane" action="/Home/Category/add" method="post" >
    <div class="layui-form-item">
        <label class="layui-form-label">分类名称</label>
        <div class="layui-input-block">
            <input type="text" name="cat_name" id="cat_name" lay-verify="required" autocomplete="off" placeholder="请输入菜单名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">父分类</label>
        <div class="layui-input-block">
            <input type="text" name="parentName" id ="parentName" autocomplete="off" value="<?=$parentName?>"  class="layui-input" disabled="" >
            <input type="hidden" name="parent_id" id ="parent_id"  value="0"   >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选择节点</label>
        <div class="layui-input-block" id="menuTree">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类描述</label>
        <div class="layui-input-block">
            <input type="text" name="cat_desc" lay-verify="title" autocomplete="off" placeholder="请输入菜单权限用','隔开" class="layui-input">
            <div class="layui-form-mid layui-word-aux">商品分类描述</div>
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
        <label class="layui-form-label">是否显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_show" value="1" title="是" checked>
            <input type="radio" name="is_show" value="2" title="否">
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
                if(e.status) {
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
            url : "/Home/Category/getTree",
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
                $("#parentid").val(item.id)
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