<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="http://at.alicdn.com/t/font_tnyc012u2rlwstt9.css" media="all" />
    <link rel="stylesheet" href="/static/css/news.css" media="all" />
    <style>
        .layui-table-cell {
            height:auto;
        }
        .layui-table-cell img {
            width:80px;
            height:80px;
            border-radius:50%;
        }
    </style>
</head>
<body class="childrenBody">
<blockquote class="layui-elem-quote news_search" style="border-left: 5px solid #2368B0;">
    <div class="layui-inline">
        <a class="layui-btn linksAdd_btn addBtn" data-title="添加用户" data-url="/Home/User/add" style="background-color:#2368B0;" href="javascript:;">添加用户</a>
    </div>
</blockquote>

<div class="demoTable">
    <div class="layui-inline">
        <input type="text" name="username" id="username" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text" name="nickname" id="nickname" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline" style="margin-left: 40px">
        <button class="layui-btn" data-type="reload">查询</button>
    </div>
</div>
<div class="layui-form news_list">
    <table class="layui-table" lay-filter="demo" lay-data="{url:'/Home/User/getList',height: 'full',
    page:true, limit:10, id:'idTest'}">
        <thead>
        <tr>
            <th lay-data="{type:'numbers'}">序号</th>
            <th lay-data="{field:'username'}">用户名</th>
            <th lay-data="{field:'nickname'}">昵称</th>
            <th lay-data="{fixed: 'right', align:'center', toolbar: '#barDemo'}">操作</th>
        </tr>
        </thead>
    </table>
    <script id="barDemo" type="text/html">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

</div>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script src="/static/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/layui/layui.all.js" charset="utf-8"></script>

<script>
    $(".addBtn").on("click", function(){
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

    layui.use('table', function(){
        var table = layui.table;
        //监听工具条
        table.on('tool(demo)', function(obj){
            var data = obj.data;
            var id = data.id;

            if(obj.event === 'edit') {
                var url = "/Home/User/edit/id/"+id;
                var name = "修改";
                layer.open({
                    type: 2,
                    title: name,
                    maxmin: true,
                    shadeClose: false, //点击遮罩关闭层
                    area: ['80%', '60%'],
                    content: url
                });
            }else if(obj.event === 'del') {
                layer.confirm('真的删除么', function (index) {
                    obj.del();
                    var url = "/admin/user/delete";
                    /*后台删除行操作*/
                    $.ajax({
                        type:"post",
                        url:url,
                        data:{"id":id},
                        dataType:"json",
                        success:function(data){
                            if(data.status){
                                layer.close(index);
                                layer.msg("删除成功");
                            }else{
                                layer.msg("删除失败");
                            }
                        }
                    })
                });
            }
        });
        var $ = layui.$, active = {
            reload: function(){
                var username = $('#username').val();
                var nickname = $("#nickname").val();
                //执行重载
                table.reload('idTest', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: {
                        username:username,
                        nickname:nickname
                    }
                });
            }
        };

        $('.demoTable .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

    });

</script>
</body>
</html>