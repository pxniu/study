<html>
<head>
    <meta charset="utf-8">
    <title>${sysName}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="http://at.alicdn.com/t/font_tnyc012u2rlwstt9.css" media="all"/>
    <link rel="stylesheet" href="/static/css/main.css" media="all"/>
    <style>
        .layui-layout-admin .layui-body {
            /*去掉底部固定区域44px*/
            bottom: 0px;

            border-top: 5px solid #fff;
            border-left: 2px solid #fff;

        }
        .layui-nav-tree .layui-nav-child dd.layui-this, .layui-nav-tree .layui-nav-child dd.layui-this a, .layui-nav-tree .layui-this, .layui-nav-tree .layui-this > a, .layui-nav-tree .layui-this > a:hover {
            background:#fff;
            color:#393D47;
        }
        .layui-nav-tree .layui-nav-child dd.layui-this a:hover {
            background:#fff;
        }
        .layui-tab-title .layui-this {
            background:#2368B0;
        }

    </style>
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header" style="background-color: #2368B0;">
        <div class="layui-main">
            <a href="#" class="logo" style="width: 280px">吉林省人社系统网络宣传矩阵</a>
            <!-- 显示/隐藏菜单 -->
            <a style="background:#fff;color:#393D47;" href="javascript:;" class="iconfont hideMenu icon-menu1"></a>
            <!-- 天气信息 -->
            <div class="weather" pc>
                <div id="tp-weather-widget"></div>
                <script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))</script>
                <script>tpwidget("init", {
                        "flavor": "slim",
                        "location": "WZC1EXZ0P9HU",
                        "geolocation": "disabled",
                        "language": "zh-chs",
                        "unit": "c",
                        "theme": "chameleon",
                        "container": "tp-weather-widget",
                        "bubble": "enabled",
                        "alarmType": "badge",
                        "color": "#FFFFFF",
                        "uid": "UA9590D7EE",
                        "hash": "bf4e58c02b13d16134d6fab7598c04ed"
                    });
                    tpwidget("show");</script>
            </div>
            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <!-- <li class="layui-nav-item showNotice" id="showNotice" pc>
                    <a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
                </li> -->
                <li class="layui-nav-item" mobile>
                    <a href="javascript:;" class="mobileAddTab" data-url="page/user/changePwd.html"><i
                                class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>设置</cite></a>
                </li>
                <li class="layui-nav-item" mobile>

                    <a href="${base}/logout.htm"><i class="iconfont icon-loginout"></i> 退出</a>

                </li>
                <!-- <li class="layui-nav-item lockcms" pc>
                    <a href="javascript:;"><i class="iconfont icon-lock1"></i><cite>锁屏</cite></a>
                </li> -->
                <li class="layui-nav-item" pc>
                    <a href="javascript:;">
                        <cite>超级管理员</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="xxx"><a href="javascript:;" data-url="" onclick="refresh();"><i
                                        class="layui-icon">&#x1002;</i><cite>刷新</cite></a></dd>
                        <dd><a href="javascript:;" data-url="/admin/user/edit/${sysUserDto.userid}"><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i><cite>个人资料</cite></a></dd>
                        <dd><a href="javascript:;" data-url="/admin/user/edit/${sysUserDto.userid}"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>修改密码</cite></a></dd>
                        <dd><a href="javascript:;" class="changeSkin noAddTab"><i class="iconfont icon-huanfu"></i><cite>更换皮肤</cite></a></dd>

                        <dd class="xxx"><a href="/admin/login/logout" class="noAddTab"><i class="iconfont icon-loginout"></i><cite>退出</cite></a>
                        </dd>

                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
    <div class="user-photo">
        <a id="img" class="img" title="我的头像" style="background:url('/static/images/face.jpg') 100% 100%;border-radius:50%;display: flex;justify-content: center;align-items:center;color:#fff;font-size:40px;" ></a>
        <p>你好！<span class="userName">guanliuan</span>, 欢迎登录</p>
    </div>
    <div class="navBar layui-side-scroll">
    <ul class="layui-nav layui-nav-tree">
        <li class="layui-nav-item layui-this"><a href="javascript:;" data-url="/admin/index/main"><i
                        class="iconfont icon-computer" data-icon="icon-computer"></i><cite>首页</cite></a></li>
        <?php
        if (!empty ($newMenu)) {
            foreach ($newMenu as $key => $val) {
                ?>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon" data-icon=""><?=$val['icon']?></i><cite><?=$val['name']?></cite><span class="layui-nav-more"></span></a>
                    <?php
                    if (!empty ($val['children'])) {
                        ?>
                        <dl class="layui-nav-child">
                            <?php
                            foreach ($val['children'] as $k => $v) {
                                ?>
                                <dd><a href="javascript:;" data-url="/<?=$v['url']?>" class="layui-icon" data-icon=""><?=$v['icon']?></i><cite><?=$v['name']?></cite></a></dd>
                                <?php
                            }
                            ?>
                        </dl>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
        }
        ?>

        <span class="layui-nav-bar" style="top: 22.5px; height: 0px; opacity: 0;"></span>
    </ul>
</div>
</div>
<!-- 右侧内容 -->
<div class="layui-body layui-form">
    <div class="layui-tab marg0" lay-filter="bodyTab" id="top_tabs_box">
        <ul class="layui-tab-title top_tab" id="top_tabs">
            <li class="layui-this" lay-id=""><i class="iconfont icon-computer"></i> <cite>首页</cite></li>
        </ul>
        <ul class="layui-nav closeBox">
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="iconfont icon-caozuo"></i> 页面操作</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" class="closePageOther"><i class="iconfont icon-prohibit"></i>
                            关闭其他</a></dd>
                    <dd><a href="javascript:;" class="closePageAll"><i class="iconfont icon-guanbi"></i> 关闭全部</a>
                    </dd>
                </dl>
            </li>
        </ul>
        <div class="layui-tab-content clildFrame" >
            <div class="layui-tab-item layui-show">
                <iframe src="/admin/index/index"></iframe>
            </div>
        </div>
    </div>
</div>

</div>

<!-- 移动导航 -->
<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>

<script type="text/javascript" src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/leftNav.js"></script>
<script type="text/javascript" src="/static/js/index.js"></script>
<script src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script>
<script type="text/javascript">
    function refresh() {
        window.location.reload();
    }

    var colorAngle = Math.floor(Math.random() * 360);
    var color = 'hsla(' + this.colorAngle + ',100%,50%,1)';
    //$("#img").css({"background": color});
</script>
</body>
</html>
