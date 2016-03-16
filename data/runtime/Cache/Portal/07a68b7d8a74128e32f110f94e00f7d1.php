<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>开发者平台</title>
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
    <div class="head deve"></div>
    <div class="developer">
        <div class="user">
            <h1 class="authorization">用户授权数据</h1>

            <div class="report">
                <ul>
                    <li>
                        <img src="/themes/simplebootx/Public/images/port1.png"/>

                        <h2>速策报告</h2>
                        <span>通话情况分析、联系人分析、出行分析、消费习惯和消费能力分析</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/port2.png"/>

                        <h2>信用卡账单</h2>
                        <span>支持中国主要银行信用卡的额度和账单分析，支持各大主流邮箱</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/port3.png"/>

                        <h2>公积金社保</h2>
                        <span>支持全国三百多个城市的公积金和社保缴费数据，工作和房贷分析</span>
                    </li>

                    <li>
                        <img src="/themes/simplebootx/Public/images/insur1.png"/>

                        <h2>保险网站</h2>
                        <span>支持中国主流的保险网站，车险财险数据</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/insur2.png"/>

                        <h2>征信网站</h2>
                        <span>支持个人征信报告的查询</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/insur3.png"/>

                        <h2>简历网站</h2>
                        <span>支持中国主流的简历网站，个人技能和工作分析</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="original-data">
            <h1 class="authorization">实时原始数据</h1>

            <div class="report">
                <ul>
                    <li>
                        <img src="/themes/simplebootx/Public/images/origina1.png"/>

                        <h2>运营商结构化数据</h2>
                        <span>个人信息、半年的（账单、通话记录、短信记录、上网记录）</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/origina2.png"/>

                        <h2>电商结构化数据</h2>
                        <span>个人信息、购物地址、最多1000条购物记录</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/origina3.png"/>

                        <h2>学历学籍结构化数据</h2>
                        <span>个人信息、专业班级、学业进度</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="original-data">
            <h1 class="authorization">风险分析</h1>

            <div class="report">
                <ul>
                    <li>
                        <img src="/themes/simplebootx/Public/images/origina4.png"/>

                        <h2>银联个人报告</h2>
                        <span>提供了基于用户线下刷卡数据的用户侧画像，包括估计有没有车、房，是否就业等</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/origina5.png"/>

                        <h2>个人不良信息</h2>
                        <span>判断某个人的不良信息，获取用户是否有不良行为</span>
                    </li>
                    <li>
                        <img src="/themes/simplebootx/Public/images/origina6.png"/>

                        <h2>黑名单身份证查询接口</h2>
                        <span>根据身份证号码匹配速策黑名单库，数据来源有网贷黑名单，合作伙伴互换</span>
                    </li>
                </ul>
            </div>
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

</body>
</html>