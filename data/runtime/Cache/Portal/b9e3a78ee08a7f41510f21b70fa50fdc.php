<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>加入我们</title>
    <link href="/themes/simplebootx/Public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/suce.css">
</head>
<body>
<!--  head区域 -->
<!--  head区域 -->
<header class="navbar-fixed-top">
	<div class="container-fluid sc-nav nav-background" id="header">
		<div class="box">
			<div class="nav">
				<a class="logo" href="javascript:void(0)"></a>
				<?php
 $effected_id="main-nav"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label
					<b class='caret'></b></a>"; $dropdown='dropdown'; $ul_class="dropdown-menu"; $li_class="" ; $style="list-inline"; $showlevel=6; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
			</div>
		</div>
	</div>
</header>

<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
<script>
	$(document).ready(function () {
		$("#main-nav a").each(function () {
			if ($(this)[0].href == String(window.location) && $(this).attr('href') != "") {
				$(this).addClass("current-active");
			}
		});
	});
</script>

<!--  main区域 -->
<div class="main">
    <div class="head join"></div>
    <div class="job-description">
        <ul>
            <li class="items-a">
                <span class="icon1">C#开发主管</span>
                <span>C#软件开发工程师</span>
                <span>Java高级工程师</span>
                <span>Java初级工程师</span>
                <span>自动化测试工程师</span>
                <span class="icon1">IT运维主管</span>
            </li>
            <li class="items-a items-b">
                <span>安卓开发工程师</span>
                <span>IOS开发工程师</span>
                <span>前端开发经理</span>
                <span>数据分析项目经理</span>
                <span>数据建模项目经理</span>
                <span>数据分析工程师</span>
            </li>
        </ul>
    </div>
    <div class="intro"><img src="/themes/simplebootx/Public/images/intro.png"/></div>
</div>

<!--  footer区域 -->
<div class="footer">
	<div class="footmr">
		<div class="foot-left">
			<?php
 $effected_id="foot-nav"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label
				<b class='caret'></b></a>"; $dropdown='dropdown'; $ul_class="dropdown-menu"; $li_class="" ; $style="foot-nav"; $showlevel=6; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
			<div class="foot-logo">
				<span><img src="/themes/simplebootx/Public/images/logopic2.png" /></span>
				<h3>Copyright © 2011-2016 www.51zhengxin .com All rights reserved.</h3>
				<h3>版权所有上海盈蜂征信服务有限公司 - 沪ICP备15046087号-1</h3>
			</div>
		</div>
		<div class="foot-right">
			<span class="bar-code"><img src="/themes/simplebootx/Public/images/logopic3.png" /></span>
            <span class="contact">
            <span>QQ:123456789</span>
            <span>电话:123456789</span>
            <span>邮箱:123456789</span>
            </span>
		</div>
	</div>
</div>

<script src="/themes/simplebootx/Public/js/headroom.min.js"></script>
<script type="text/javascript">
	$(".navbar-fixed-top").headroom();
</script>
   
</body>
</html>