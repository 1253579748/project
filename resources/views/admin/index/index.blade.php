<<<<<<< HEAD
<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>后台登录-X-admin2.2</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="./css/font.css">
        <link rel="stylesheet" href="./css/xadmin.css">
        <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="./js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>
    <body class="index">
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a href="./index.html">X-admin v2.2</a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav left fast-add" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">+新增</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                                <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">admin</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
                        <dd>
                            <a onclick="xadmin.open('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
                        <dd>
                            <a href="./login.html">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/">前台首页</a></li>
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
            <div id="side-nav">
                <ul id="nav">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                            <cite>会员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('统计页面','/admin/add')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>统计页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员列表(静态表格)','member-list.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员列表(静态表格)</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员列表(动态表格)','member-list1.html',true)">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员列表(动态表格)</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员删除','member-del.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员删除</cite></a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="iconfont">&#xe70b;</i>
                                    <cite>会员管理</cite>
                                    <i class="iconfont nav_right">&#xe697;</i></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a onclick="xadmin.add_tab('会员删除','member-del.html')">
                                            <i class="iconfont">&#xe6a7;</i>
                                            <cite>会员删除</cite></a>
                                    </li>
                                    <li>
                                        <a onclick="xadmin.add_tab('等级管理','member-list1.html')">
                                            <i class="iconfont">&#xe6a7;</i>
                                            <cite>等级管理</cite></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                            <cite>会员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('统计页面','')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>统计页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员列表(静态表格)','/admin/add')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员列表(静态表格)</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员列表(动态表格)','member-list1.html',true)">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员列表(动态表格)</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('会员删除','member-del.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员删除</cite></a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="iconfont">&#xe70b;</i>
                                    <cite>会员管理</cite>
                                    <i class="iconfont nav_right">&#xe697;</i></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a onclick="xadmin.add_tab('会员删除','member-del.html')">
                                            <i class="iconfont">&#xe6a7;</i>
                                            <cite>会员删除</cite></a>
                                    </li>
                                    <li>
                                        <a onclick="xadmin.add_tab('等级管理','member-list1.html')">
                                            <i class="iconfont">&#xe6a7;</i>
                                            <cite>等级管理</cite></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="订单管理">&#xe723;</i>
                            <cite>订单管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('订单列表','order-list.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>订单列表</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('订单列表1','order-list1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>订单列表1</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe723;</i>
                            <cite>分类管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('多级分类','cate.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>多级分类</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="城市联动">&#xe723;</i>
                            <cite>城市联动</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('三级地区联动','city.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>三级地区联动</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                            <cite>管理员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('管理员列表','admin-list.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>管理员列表</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('角色管理','admin-role.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>角色管理</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('权限分类','admin-cate.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>权限分类</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('权限管理','admin-rule.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>权限管理</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="系统统计">&#xe6ce;</i>
                            <cite>系统统计</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('拆线图','echarts1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>拆线图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('拆线图','echarts2.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>拆线图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('地图','echarts3.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>地图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('饼图','echarts4.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>饼图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('雷达图','echarts5.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>雷达图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('k线图','echarts6.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>k线图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('热力图','echarts7.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>热力图</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('仪表图','echarts8.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>仪表图</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="图标字体">&#xe6b4;</i>
                            <cite>图标字体</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('图标对应字体','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>图标对应字体</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="其它页面">&#xe6b4;</i>
                            <cite>其它页面</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="login.html" target="_blank">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>登录页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('错误页面','error.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>错误页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('示例页面','demo.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>示例页面</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('更新日志','log.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>更新日志</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="第三方组件">&#xe6b4;</i>
                            <cite>layui第三方组件</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('滑块验证','https://fly.layui.com/extend/sliderVerify/')" target="">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>滑块验证</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('富文本编辑器','https://fly.layui.com/extend/layedit/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>富文本编辑器</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('eleTree 树组件','https://fly.layui.com/extend/eleTree/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>eleTree 树组件</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('图片截取','https://fly.layui.com/extend/croppers/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>图片截取</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('formSelects 4.x 多选框','https://fly.layui.com/extend/formSelects/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>formSelects 4.x 多选框</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('Magnifier 放大镜','https://fly.layui.com/extend/Magnifier/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>Magnifier 放大镜</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('notice 通知控件','https://fly.layui.com/extend/notice/')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>notice 通知控件</cite></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
                <ul class="layui-tab-title">
                    <li class="home">
                        <i class="layui-icon">&#xe68e;</i>我的桌面</li></ul>
                <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                    <dl>
                        <dd data-type="this">关闭当前</dd>
                        <dd data-type="other">关闭其它</dd>
                        <dd data-type="all">关闭全部</dd></dl>
                </div>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe src='./welcome.html' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                    </div>
                </div>
                <div id="tab_show"></div>
            </div>
        </div>
        <div class="page-content-bg"></div>
        <style id="theme_style"></style>
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->
        <script>//百度统计可去掉
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

=======
<!DOCTYPE HTML>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="/admin/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="/admin/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="/admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="/admin/js/jquery-1.11.1.min.js"></script>
<script src="/admin/js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="/admin/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="/admin/js/wow.min.js"></script>
    <script>
         new WOW().init();
    </script>
<!--//end-animate-->
<!-- chart -->
<script src="/admin/js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="/admin/css/clndr.css" type="text/css" />
<script src="/admin/js/underscore-min.js" type="text/javascript"></script>
<script src= "/admin/js/moment-2.2.1.js" type="text/javascript"></script>
<script src="/admin/js/clndr.js" type="text/javascript"></script>
<script src="/admin/js/site.js" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="/admin/js/metisMenu.min.js"></script>
<script src="/admin/js/custom.js"></script>
<link href="/admin/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
                <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.html" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs nav_icon"></i>Components <span class="nav-badge">12</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="grids.html">Grid System</a>
                                </li>
                                <li>
                                    <a href="media.html">Media Objects</a>
                                </li>
                            </ul>
                            <!-- /nav-second-level -->
                        </li>
                        <li class="">
                            <a href="#"><i class="fa fa-book nav_icon"></i>UI Elements <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="general.html">General<span class="nav-badge-btm">08</span></a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                            </ul>
                            <!-- /nav-second-level -->
                        </li>
                        <li>
                            <a href="widgets.html"><i class="fa fa-th-large nav_icon"></i>Widgets <span class="nav-badge-btm">08</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope nav_icon"></i>Mailbox<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="inbox.html">Inbox <span class="nav-badge-btm">05</span></a>
                                </li>
                                <li>
                                    <a href="compose.html">Compose email</a>
                                </li>
                            </ul>
                            <!-- //nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table nav_icon"></i>Tables <span class="nav-badge">05</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-check-square-o nav_icon"></i>Forms<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="forms.html">Basic Forms <span class="nav-badge-btm">07</span></a>
                                </li>
                                <li>
                                    <a href="validation.html">Validation</a>
                                </li>
                            </ul>
                            <!-- //nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text-o nav_icon"></i>Pages<span class="nav-badge-btm">02</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="signup.html">SignUp</a>
                                </li>
                                <li>
                                    <a href="blank-page.html">Blank Page</a>
                                </li>
                            </ul>
                            <!-- //nav-second-level -->
                        </li>
                        <li>
                            <a href="charts.html" class="chart-nav"><i class="fa fa-bar-chart nav_icon"></i>Charts <span class="nav-badge-btm pull-right">new</span></a>
                        </li>
                    </ul>
                    <!-- //sidebar-collapse -->
                </nav>
            </div>
        </div>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="sticky-header header-section ">
            <div class="header-left">
                <!--toggle button start-->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <!--toggle button end-->
                <!--logo -->
                <div class="logo">
                    <a href="index.html">
                        <h1>NOVUS</h1>
                        <span>AdminPanel</span>
                    </a>
                </div>
                <!--//logo-->
                <!--search-box-->
                <div class="search-box">
                    <form class="input">
                        <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
                        <label class="input__label" for="input-31">
                            <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                            </svg>
                        </label>
                    </form>
                </div><!--//end-search-box-->
                <div class="clearfix"> </div>
            </div>
            <div class="header-right">
                <div class="profile_details_left"><!--notifications of menu start -->
                    <ul class="nofitications-dropdown">
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 3 new messages</h3>
                                    </div>
                                </li>
                                <li><a href="#">
                                   <div class="user_img"><img src="/admin/images/1.png" alt=""></div>
                                   <div class="notification_desc">
                                    <p>Lorem ipsum dolor amet</p>
                                    <p><span>1 hour ago</span></p>
                                    </div>
                                   <div class="clearfix"></div> 
                                </a></li>
                                <li class="odd"><a href="#">
                                    <div class="user_img"><img src="/admin/images/2.png" alt=""></div>
                                   <div class="notification_desc">
                                    <p>Lorem ipsum dolor amet </p>
                                    <p><span>1 hour ago</span></p>
                                    </div>
                                  <div class="clearfix"></div>  
                                </a></li>
                                <li><a href="#">
                                   <div class="user_img"><img src="/admin/images/3.png" alt=""></div>
                                   <div class="notification_desc">
                                    <p>Lorem ipsum dolor amet </p>
                                    <p><span>1 hour ago</span></p>
                                    </div>
                                   <div class="clearfix"></div> 
                                </a></li>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#">See all messages</a>
                                    </div> 
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 3 new notification</h3>
                                    </div>
                                </li>
                                <li><a href="#">
                                    <div class="user_img"><img src="/admin/images/2.png" alt=""></div>
                                   <div class="notification_desc">
                                    <p>Lorem ipsum dolor amet</p>
                                    <p><span>1 hour ago</span></p>
                                    </div>
                                  <div class="clearfix"></div>  
                                 </a></li>
                                 <li class="odd"><a href="#">
                                    <div class="user_img"><img src="/admin/images/1.png" alt=""></div>
                                   <div class="notification_desc">
                                    <p>Lorem ipsum dolor amet </p>
                                    <p><span>1 hour ago</span></p>
                                    </div>
                                   <div class="clearfix"></div> 
                                 </a></li>
                                 <li><a href="#">
                                    <div class="user_img"><img src="/admin/images/3.png" alt=""></div>
                                   <div class="notification_desc">
                                    <p>Lorem ipsum dolor amet </p>
                                    <p><span>1 hour ago</span></p>
                                    </div>
                                   <div class="clearfix"></div> 
                                 </a></li>
                                 <li>
                                    <div class="notification_bottom">
                                        <a href="#">See all notifications</a>
                                    </div> 
                                </li>
                            </ul>
                        </li>   
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">15</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have 8 pending task</h3>
                                    </div>
                                </li>
                                <li><a href="#">
                                    <div class="task-info">
                                        <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                        <div class="clearfix"></div>    
                                    </div>
                                    <div class="progress progress-striped active">
                                        <div class="bar yellow" style="width:40%;"></div>
                                    </div>
                                </a></li>
                                <li><a href="#">
                                    <div class="task-info">
                                        <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                       <div class="clearfix"></div> 
                                    </div>
                                    <div class="progress progress-striped active">
                                         <div class="bar green" style="width:90%;"></div>
                                    </div>
                                </a></li>
                                <li><a href="#">
                                    <div class="task-info">
                                        <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                        <div class="clearfix"></div>    
                                    </div>
                                   <div class="progress progress-striped active">
                                         <div class="bar red" style="width: 33%;"></div>
                                    </div>
                                </a></li>
                                <li><a href="#">
                                    <div class="task-info">
                                        <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                       <div class="clearfix"></div> 
                                    </div>
                                    <div class="progress progress-striped active">
                                         <div class="bar  blue" style="width: 80%;"></div>
                                    </div>
                                </a></li>
                                <li>
                                    <div class="notification_bottom">
                                        <a href="#">See all pending tasks</a>
                                    </div> 
                                </li>
                            </ul>
                        </li>   
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <!--notification menu end -->
                <div class="profile_details">       
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">   
                                    <span class="prfil-img"><img src="/admin/images/a.png" alt=""> </span> 
                                    <div class="user-name">
                                        <p>Wikolia</p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>    
                                </div>  
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                                <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                                <li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>               
            </div>
            <div class="clearfix"> </div>   
        </div>
        <!-- //header-ends -->
        <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >手机网站模板</a></div>
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                 @yield("main")
                <div class="row calender widget-shadow" style="display:none;">
                    <h4 class="title">Calender</h4>
                    <div class="cal1">
                        
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!--footer-->
        <div class="footer">
           <p>Copyright &copy; 2016.Company name All rights reserved.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
        </div>
        <!--//footer-->
    </div>
    <!-- Classie -->
        <script src="/admin/js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
                showLeftPush = document.getElementById( 'showLeftPush' ),
                body = document.body;
                
            showLeftPush.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( body, 'cbp-spmenu-push-toright' );
                classie.toggle( menuLeft, 'cbp-spmenu-open' );
                disableOther( 'showLeftPush' );
            };
            

            function disableOther( button ) {
                if( button !== 'showLeftPush' ) {
                    classie.toggle( showLeftPush, 'disabled' );
                }
            }
        </script>
    <!--scrolling js-->
    <script src="/admin/js/jquery.nicescroll.js"></script>
    <script src="/admin/js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
   <script src="/admin/js/bootstrap.js"> </script>
</body>
>>>>>>> 16a3e064518d46f62fca969954d1bff5fecde4f4
</html>