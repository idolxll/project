<?php 
require 'Common/common.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界-总后台管理系统</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="bookmark" href="favicon.ico" >
    <link rel="shortcuticon" href="favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <script type="text/javascript" src="js/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="fixed-sidebar full-height-layout">
	<div id="wrapper">
		<nav id="navbar-default" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse">
                <div class="logo">
                    <img src="img/logo.png">
                    <h1>后台管理系统</h1>
                </div>
                <div class="logo-element"><img src="img/logo2.png"></div>
                <ul id="side-menu">
                	<li>
                		<a href="javascript:;">
                			<i class="iconfont will-shangpin"></i>
                			<span>线路管理</span>
                		</a>
                		<ul>
                			<li><a class="will-menuItem" href="template/product/listproduct.php">线路</a></li>
                			<li><a class="will-menuItem" href="template/product/productCategory.php">线路分类</a></li>
                		</ul>
                	</li>
                	<li>
                		<a href="javascript:;">
                			<i class="iconfont will-yunying"></i>
                			<span>渠道管理</span>
                		</a>
                		<ul class="collapse">
                			<li><a class="will-menuItem" href="template/channel/ListOperators.php">运营中心列表</a></li>
                			<li><a class="will-menuItem" href="template/channel/ListAgent.php">服务商列表</a></li>
                		</ul>
                	</li>
                	<!--<li>
                		<a href="javascript:;">
                			<i class="iconfont will-huiyuanguanli1"></i>
                			<span>会员管理</span>
                		</a>
                		<ul class="collapse">
                			<li><a class="will-menuItem" href="template/member/listMember.php">会员列表</a></li>
                			<li><a class="will-menuItem" href="template/member/listCzxf.php">充值消费记录</a></li>
                			<li><a class="will-menuItem" href="template/member/listConsume.php">消费列表</a></li>
                			<li><a class="will-menuItem" href="template/member/listIntegral.php">积分兑换</a></li>
                			<li><a class="will-menuItem" href="template/member/vipCard.php">会员卡设置</a></li>
                			<li><a class="will-menuItem" href="template/member/memberTemplate.php">会员卡模板设置</a></li>
                		</ul>
                	</li>
                	<li>
                		<a href="javascript:;">
                			<i class="iconfont will-caiwuguanli"></i>
                			<span>财务管理</span>
                		</a>
                		<ul>
                			<li><a class="will-menuItem" href="template/finance/withdrawal.php">余额提现</a></li>
                			<li><a class="will-menuItem" href="template/finance/listIncomeSpending.php">当面付明细</a></li>
                			<li><a class="will-menuItem" href="template/finance/listOtherFiles.php">其他收支</a></li>
                		</ul>
                	</li>
                	<li>
                		<a href="javascript:;">
                			<i class="iconfont will-1395biaogemianban"></i>
                			<span>报表中心</span>
                		</a>
                		<ul>
                			<li><a class="will-menuItem" href="template/table/detailsPaymentTabel.php">收支报表</a></li>
                			<li><a class="will-menuItem" href="template/table/orderSumTabel.php">订单明细</a></li>
                			<li><a class="will-menuItem" href="template/table/orderReturnsTabel.php">退货明细</a></li>
                			<li><a class="will-menuItem" href="template/table/listJhbTabel.php">交换班记录</a></li>
                			<li><a class="will-menuItem" href="template/table/listJhbTabelZb.php">交换班记录（总部）</a></li>
                			<li><a class="will-menuItem" href="template/table/goodsSaleTabel.php">商品销售排行</a></li>
                			<li><a class="will-menuItem" href="template/table/goodsPsitTabel.php">商品进销存</a></li>
                			<li><a class="will-menuItem" href="template/table/materialPsitTabel.php">原料进销存</a></li>
                			<li><a class="will-menuItem" href="template/table/dayReportTabel.php">门店日结报表</a></li>
                			<li><a class="will-menuItem" href="template/table/monthlyStatementTabel.php">门店月结报表</a></li>
                			<li><a class="will-menuItem" href="template/table/dataAnalysisTabel.php">客流分析</a></li>
                			<li><a class="will-menuItem" href="template/table/dataValueTabel.php">客流价值分析</a></li>
                		</ul>
                	</li>
                	<li>
                		<a href="javascript:;">
                			<i class="iconfont will-xitongshezhi"></i>
                			<span>系统设置</span>
                		</a>
                		<ul>
                			<li><a class="will-menuItem" href="template/setup/wechatAuthorization.php">微信授权</a></li>
                			<li><a class="will-menuItem" href="template/setup/wechatMbxx.php">模板消息</a></li>
                			<li><a class="will-menuItem" href="template/setup/wechatCustomMenu.php">自定义菜单</a></li>
                		</ul>
                	</li>-->
                </ul>
            </div>
        </nav>
        <div id="right">
            <div class="row top">
                <nav class="navbar navbar-static-top">
                	<a class="navbar-minimalize btn btn-primary" href="#"><i class="iconfont will-liebiao1"></i></a>
                	<div class="welcome"><span><?php echo $_SESSION["DisplayName"];?></span>欢迎您登录观世界总后台！</div>
                	<a class="will-menuItem pwd-btn" href="changePassword.php"><i class="iconfont will-xiugaimima"></i>修改密码</a>
                	<div class="msg-btn">
                		<a class="will-menuItem" href="changePassword.php">
	                		<i class="iconfont will-tongzhi"></i>
	                		<span>最新消息</span>
                		</a>
                		<em class="label-danger">28</em>
                	</div>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left"><i class="iconfont will-houtui"></i></button>
                <nav class="page-tabs will-menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active will-menuTab" data-id="welcome.php">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right will-tabRight"><i class="iconfont will-qianjin"></i></button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown will-tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="will-tabCloseAll"><a>关闭全部选项卡</a></li>
                        <li class="will-tabCloseOther"><a>关闭其他选项卡</a></li>
                    </ul>
                </div>
                <a href="login.php" class="roll-nav roll-right will-tabExit"><i class="iconfont will-tuichu"></i>退出</a>
            </div>
            <div id="main" class="row willContent">
               	<iframe class="will-iframe" name="iframe" width="100%" height="100%" src="welcome.php" data-id="welcome.php" frameborder="0" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">
                    Copyright © 2016-2017 <a href="#" target="_blank">观世界旅游</a>
                </div>
            </div>
        </div>
	</div>
	<div id="browser_ie">
		<div class="brower_info">
			<div class="notice_info">
				<p>你的浏览器版本过低，可能导致网站不能正常访问！<BR>为了你能正常使用网站功能，请使用这些浏览器。</p>
			</div>
			<div class="browser_list">
				<span>
					<a  href="http://www.google.cn/intl/zh-CN/chrome/browser/" target="_blank">
						<img src="img/Chrome.png" />Chrome
					</a>
				</span>
				<span>
					<a href="http://www.firefox.com.cn/" target="_blank">
						<img src="img/Firefox.png" />Firefox
					</a>
				</span>
				<span>
					<a href="https://www.apple.com/cn/safari/" target="_blank">
						<img src="img/Safari.png" />Safari
					</a>
				</span>
				<span>
					<a href="http://rj.baidu.com/soft/detail/23360.php?ald" target="_blank">
						<img src="img/IE.png" />IE10及以上
					</a>
				</span>
			</div>
		</div>
	</div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/metisMenu/jquery.metisMenu.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="js/layer/layer.min.js"></script>
    <script type="text/javascript" src="js/contabs.js"></script>
    <script type="text/javascript" src="js/will.js"></script>
    <script>
		if(navigator.appName == "Microsoft Internet Explorer"&&parseInt(navigator.appVersion.split(";")[1].replace(/[ ]/g, "").replace("MSIE",""))<10){
	        $("#browser_ie").show();
	        $("#wrapper").hide();
	    }
	</script>
</body>
</html>