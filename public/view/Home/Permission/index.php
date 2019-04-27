<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>菜单管理</title>
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
    <legend>系统菜单管理</legend>
</fieldset>

<div class="site-demo-button" style="margin-bottom: 0;">
    <button class="layui-btn site-demo-active addBtn" data-title="新增菜单" data-url="/Home/Permission/add/pid/0" data-type="tabAdd">新增菜单</button>
</div>

<div class="layui-form">

    <table class="layui-table">
        <colgroup>
            <col width="250">
            <col width="250">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>菜单名称</th>
            <th>菜单URL</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="tbDatalist">
        <?php
        if (!empty ($newList)) {
            foreach ($newList as $key => $val) {
        ?>
                <tr>
                    <td><i class="layui-icon" data-icon=""><?=$val['icon']?></i><?php echo str_repeat("&nbsp;&nbsp", $val['level']); echo $val['name']; ?></td>
                    <td><?php echo $val['url']; ?></td>

                    <td>
                        <a class="layui-btn layui-btn-mini links_edit editBtn" data-title="修改菜单" data-url="/Home/Permission/menu/edit/<%=sysPermissionDto.getId()%>"><i class="iconfont icon-edit"></i>修改</a>
                        <a class="layui-btn layui-btn-danger layui-btn-mini links_del" href="javascript:void(0);" onclick="del('<%=sysPermissionDto.getId()%>');" ><i class="layui-icon"></i>删除</a>

                        <a class="layui-btn layui-btn-mini links_edit addSonBtn" data-title="添加下级菜单" data-url="/Home/Permission/add/pid/<?php echo $val['id']; ?>" href="javascript:;"><i class="iconfont icon-edit"></i>添加下级菜单</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
        </tbody>
    </table>

</div>

<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script>
    layui.use('form', function(){
        var $ = layui.jquery, form = layui.form;

        //全选
        form.on('checkbox(allChoose)', function(data){
            var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
            child.each(function(index, item){
                item.checked = data.elem.checked;
            });
            form.render('checkbox');
        });

        $(".addBtn").on("click", function(){
            var url = $(this).attr("data-url");
            var title = $(this).attr("data-title");
            layer.open({
                type: 2,
                title: title,
                maxmin: true,
                shadeClose: false, //点击遮罩关闭层
                area : ['80%' , '60%'],
                content: "/Home/Permission/add/pid/0"
            });
        });

        $(".addSonBtn").on("click", function(){
            var url = $(this).attr("data-url");
            var title = $(this).attr("data-title");
            layer.open({
                type: 2,
                title: title,
                maxmin: true,
                shadeClose: false, //点击遮罩关闭层
                area : ['80%' , '60%'],
                content: url
            });
        });

        $(".editBtn").on("click", function(){
            var url = $(this).attr("data-url");
            var title = $(this).attr("data-title");
            layer.open({
                type: 2,
                title: title,
                maxmin: true,
                shadeClose: false, //点击遮罩关闭层
                area : ['80%' , '60%'],
                content: url
            });
        });


        function del(id) {
            layer.confirm('确定删除该条菜单吗?', function(index){
                $.ajax({
                    type : "post",
                    url : "/admin/menu/delete",
                    data : {
                        id : id
                    },
                    dataType : "json",
                    async : false,
                    success : function(data) {
                        if(data.status) {
                            layer.msg('删除成功！', {
                                icon: 1,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                                //do something
                                window.location.reload();
                            });
                        } else {
                            layer.msg(data.msg);
                        }
                    }
                });
            });
        }


    });


</script>
</body>
</html>