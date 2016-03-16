<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>驾驭数据</title>
    <link href="/themes/simplebootx/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/css/common.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/css/suce.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/css/animate.css" rel="stylesheet">
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
<section class="large-header headbackground" style="height: 713px;">
    <div class="banner-text text-center animated fadeInUp slowes">
        <ul class="list-unstyled">
            <li class=""><img src="/themes/simplebootx/Public/images/number1.png"></li>
            <li class="unlow"><img src="/themes/simplebootx/Public/images/number2.png"></li>
        </ul>
    </div>
</section>
<div class="container-fluid show-data showda">
    <ul class="list-unstyled text-center" style="perspective: 1000px;">
        <li data-move-y="500px"><img src="/themes/simplebootx/Public/images/operator1.png"/></li>
        <li class="block" data-move-y="500px"><img src="/themes/simplebootx/Public/images/operator2.png"/></li>

    </ul>
</div>
<div class="clear"></div>

<div class="container-fluid show-data ">
    <ul class="list-unstyled text-center" style="perspective: 1000px;">
        <li class="block" data-move-y="500px">截止昨天，已经有<span id="yesterday" class="text-blue">5,007,559</span>个用户使用了速策数据
        </li>
        <li class="block" data-move-y="500px">昨天，通过速策数据的分析报告，合作金融当日放款<span class="text-blue"
                                                                           id="money">65,607,000</span>元
        </li>
        <li class="block" data-move-y="500px">我们整合了来自<span class="text-blue">23</span>个渠道的数据
        </li>
        <li class="block" data-move-y="500px">一次使用，金融机构将获得<span class="text-blue">700+</span>个风控指标
        </li>
        <li class="block" data-move-y="500px">目前，我们已将帮助<span class="text-blue">120+</span>个金融机构使用互联网数据
        </li>
        <li class="block" data-move-y="500px"><a href="" class="btn btn-primary btn-lg btn-padding">申请试用</a></li>

    </ul>
</div>
<div class="container-fluid">
    <div class="box">
        <div class="client-list">
            <ul class="list-inline text-center" style="perspective: 1000px;">
                <li class="block" data-move-x="500px"><img src="/themes/simplebootx/Public/images/linepic1.png"></li>
                <li class="block" data-move-x="-500px"><img src="/themes/simplebootx/Public/images/linepic2.png"></li>
                <li class="block" data-move-x="500px"><img src="/themes/simplebootx/Public/images/linepic3.png"></li>

            </ul>
        </div>
    </div>
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

<script src="/themes/simplebootx/Public/js/jquery.smoove.js"></script>
<script type="text/javascript">
    $('.block').smoove({
        offset: '20%'
    })
</script>


</body>
</html>