<?php 
include_once '../../../Action/OdrorderAction.php';
require '../../Common/common.php'; 
$order = new OdrorderAction();
$orderid = $_GET["orderid"];//订单ID
$result = $order->orderinfo($orderid);
$rows = $result[0];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-消费详情</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../css/will.css" />
</head>
<body ng-app="myApp">
	<div class="wrapper" ng-controller="listController">
		<div class="content">
			<div class="wbox">
				<div class="wbox-content">
				<!--查看购买明细-->
					<div class="popup-body">
						<p><span>单号：</span><?php echo $rows["orderno"];?></p>
						<p><span>时间：</span><?php echo $rows["createDate"];?></p>
						<p><span>订单状态：</span><?php if($rows["orderState"]==0){echo "待确认";}elseif($rows["orderState"]==1){echo "待支付";}else if($rows["orderState"]==2){echo "已支付";}else if($rows["orderState"]==3){echo "已取消";}else if($rows["orderState"]==4){echo "已完成";}?></p>
						<p><span>游客姓名：</span><?php echo $rows["displayname"];?></p>
						<p><span>游客手机：</span><?php echo $rows["mobile"];?></p>
						<p ng-if="info.orderType==1"><span>消费方式：</span><?php if($rows["orderType"]==1){echo "微信支付";}elseif($rows["orderType"]==2){echo "支付宝";}else if($rows["orderType"]==3){echo "账户余额";}?></p>
						<p><span>消费产品：</span><?php echo $rows["productname"];?></p>
						<!--<ul>
							<li>
								<h5>手磨纯种蓝山咖啡</h5>
								<b>*1</b>
								<span>￥30</span>
								<div class="pb-sx">热&nbsp;大杯</div>
							</li>
							<li>
								<h5>手磨纯种蓝山咖啡</h5>
								<b>*1</b>
								<span>￥30</span>
								<div class="pb-sx">热&nbsp;大杯</div>
							</li>
						</ul>-->
						<p><span>实付金额：</span>￥<?php echo $rows["totalamount"];?></p>
					</div>
				</div>
			</div>
		</div>
		<!--查看购买明细-->
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
</body>
</html>