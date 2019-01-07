<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="favicon.ico">
    <link rel="Shortcut Icon" href="favicon.ico"/>·
    <link rel="stylesheet" href="{{ URL::asset('/Huiadmin/static/h-ui/css/H-ui.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Huiadmin/static/h-ui.admin/css/H-ui.admin.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Huiadmin/lib/Hui-iconfont/1.0.8/iconfont.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Huiadmin/static/h-ui.admin/skin/default/skin.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Huiadmin/static/h-ui.admin/css/style.css') }}">
    <script type="text/javascript" src="{{ URL::asset('/Huiadmin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"><a class="logo navbar-logo f-l mr-10 hidden-xs" href="/">全讯管理端</a>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>管理员</li>
                    <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo Auth::user()->name; ?><i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="/loginout">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        @foreach($power_finfo as $value)
            <dl id="menu-article">
                <dt><i class="Hui-iconfont">&#xe616;</i> {{ $value->p_name }}<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        @foreach($power_cinfo as $val)
                            @if($value->p_id == $val->f_id)
                                <li><a data-href="{{ $val->p_url }}" data-title="{{ $val->p_name }}" href="javascript:void(0)">{{ $val->p_name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </dd>
            </dl>
        @endforeach
        {{--<dl id="menu-article">--}}
            {{--<dt><i class="Hui-iconfont">&#xe616;</i> 活动管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="/activity" data-title="活动管理" href="javascript:void(0)">活动管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-article">--}}
            {{--<dt><i class="Hui-iconfont">&#xe616;</i> 广告管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="/advertising" data-title="广告管理" href="javascript:void(0)">广告管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-article">--}}
            {{--<dt><i class="Hui-iconfont">&#xe616;</i> 赛事管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="/match" data-title="赛事管理" href="javascript:void(0)">赛事管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-article">--}}
            {{--<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="/newsinformation" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl> --}}
        {{--<dl id="menu-article">--}}
            {{--<dt><i class="Hui-iconfont">&#xe616;</i> 公告管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="/bulletin" data-title="公告管理" href="javascript:void(0)">公告管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-article">--}}
            {{--<dt><i class="Hui-iconfont">&#xe616;</i> ip管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                    {{--<ul>--}}
                            {{--<li><a data-href="/ip_info" data-title="ip管理" href="javascript:void(0)">ip管理</a></li>--}}
                        {{--</ul>--}}
                {{--</dd>--}}
        {{--</dl>--}}

        {{--<dl id="menu-picture">--}}
            {{--<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="picture-list.html" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-product">--}}
            {{--<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>--}}
                    {{--<li><a data-href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>--}}
                    {{--<li><a data-href="product-list.html" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-comments">--}}
            {{--<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="javascript:;">评论列表</a></li>--}}
                    {{--<li><a data-href="feedback-list.html" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-member">--}}
            {{--<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="member-list.html" data-title="会员列表" href="javascript:;">会员列表</a></li>--}}
                    {{--<li><a data-href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>--}}
                    {{--<li><a data-href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>--}}
                    {{--<li><a data-href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>--}}
                    {{--<li><a data-href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>--}}
                    {{--<li><a data-href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>--}}
                    {{--<li><a data-href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-admin">--}}
            {{--<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="admin-role.html" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>--}}
                    {{--<li><a data-href="admin-permission.html" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>--}}
                    {{--<li><a data-href="/users" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-tongji">--}}
            {{--<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="charts-1.html" data-title="折线图" href="javascript:void(0)">折线图</a></li>--}}
                    {{--<li><a data-href="charts-2.html" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>--}}
                    {{--<li><a data-href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>--}}
                    {{--<li><a data-href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>--}}
                    {{--<li><a data-href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>--}}
                    {{--<li><a data-href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>--}}
                    {{--<li><a data-href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
        {{--<dl id="menu-system">--}}
            {{--<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
            {{--<dd>--}}
                {{--<ul>--}}
                    {{--<li><a data-href="system-base.html" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>--}}
                    {{--<li><a data-href="system-category.html" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>--}}
                    {{--<li><a data-href="system-data.html" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>--}}
                    {{--<li><a data-href="system-shielding.html" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>--}}
                    {{--<li><a data-href="system-log.html" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>--}}
                {{--</ul>--}}
            {{--</dd>--}}
        {{--</dl>--}}
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>

<!-- 公共头部代码 -->

@yield('content')

<!-- 公共尾部代码 -->
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/lib/layer/2.4/layer.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/static/h-ui/js/H-ui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/static/h-ui.admin/js/H-ui.admin.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/static/h-ui.admin/js/H-ui.admin.page.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $("#menu-article li").each(function () {
            if ($(this).children('a').attr('href') == String(window.location.pathname)){
                $(this).parent().parent().parent().addClass('selected');
                $(this).parent().parent().show();
                $(this).addClass('current');
            }
        });
        $("#article-admin li").each(function () {
            if ($(this).children('a').attr('href') == String(window.location.pathname)){
                $(this).parent().parent().parent().addClass('selected');
                $(this).parent().parent().show();
                $(this).addClass('current');
            }
        });
    });
</script>
</body>
</html>