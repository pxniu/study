<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>角色管理</title>
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

<!-- 列表end -->
<table id="table1" class="layui-table" lay-filter="table1"></table>


<script type="text/javascript" src="/static/layui/layui.js"></script>
<script src="/static/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/layui/layui.all.js" charset="utf-8"></script>
<style>
    .treeTable-empty {
        width: 20px;
        display: inline-block;
    }

    .treeTable-icon {
        cursor: pointer;
    }

    .treeTable-icon .layui-icon-triangle-d:before {
        content: "\e623";
    }

    .treeTable-icon.open .layui-icon-triangle-d:before {
        content: "\e625";
        background-color: transparent;
    }
</style>
<script type="text/html" id="auth-state">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.config({
        base: 'module/'
    }).extend({
        treetable: '../../static/layui/lay/module/treetable-lay/treetable'
    }).use(['treetable'], function () {
        var treetable = layui.treetable;
        // 渲染表格
        treetable.render({
            treeColIndex: 2,          // treetable新增参数
            treeSpid: -1,             // treetable新增参数
            treeIdName: 'd_id',       // treetable新增参数
            treePidName: 'd_pid',     // treetable新增参数
            treeDefaultClose: false,   // treetable新增参数
            treeLinkage: true,        // treetable新增参数
            elem: '#table1',
            url: '/Home/Category/json',
            cols: [[
                {type: 'numbers'},
                {field: 'name', minWidth: 200, title: '权限名称'},
                //{field: 'authority', title: '权限标识'},
                //{field: 'menuUrl', title: '菜单url'},
                //{field: 'orderNumber', width: 80, align: 'center', title: '排序号'},
//                {
//                    field: 'isMenu', width: 80, align: 'center', templet: function (d) {
//                    if (d.isMenu == 1) {
//                        return '<span class="layui-badge layui-bg-gray">按钮</span>';
//                    }
//                    if (d.parentId == -1) {
//                        return '<span class="layui-badge layui-bg-blue">目录</span>';
//                    } else {
//                        return '<span class="layui-badge-rim">菜单</span>';
//                    }
//                }, title: '类型'
                //},
                {templet: '#auth-state', width: 120, align: 'center', title: '操作'}
            ]]
        });
    });
</script>
</body>
</html>