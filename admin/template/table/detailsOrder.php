<?php 
require '../../Common/common.php'; 
$orderid = $_GET["orderid"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-订单详情</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../css/will.css" />
    <script charset="utf-8" src="../../js/angular.min.js"></script>
</head>
<body ng-app="myApp">
	<div class="wrapper" ng-controller="listController">
		<div class="content">
			<div class="wbox">
				<div class="wbox-content">
					<div class="popup-body">
						<p><span>单号：</span>{{list.orderno}}</p>
						<p><span>时间：</span>{{list.createDate}}</p>
						<p ng-if="list.orderState==0"><span>订单状态：</span>待确认</p>
						<p ng-if="list.orderState==1"><span>订单状态：</span>待支付</p>
						<p ng-if="list.orderState==2"><span>订单状态：</span>已支付</p>
						<p ng-if="list.orderState==3"><span>订单状态：</span>已取消</p>
						<p ng-if="list.orderState==4"><span>订单状态：</span>已完成</p>
						<p><span>游客姓名：</span>{{list.displayname}}</p>
						<p><span>游客手机：</span>{{list.mobile}}</p>
						<p ng-if="list.srcType==1"><span>订单类型：</span>抢购</p>
						<p ng-if="list.srcType==2"><span>订单类型：</span>预定</p>
						<p ng-if="list.orderType==1"><span>消费方式：</span>微信支付</p>
						<p ng-if="list.orderType==2"><span>消费方式：</span>支付宝</p>
						<p ng-if="list.orderType==3"><span>消费方式：</span>账户余额</p>
						<p><span>消费产品：</span>{{list.productname}}</p>
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
						<p><span>实付金额：</span>￥{{list.totalamount}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
	<script type="text/javascript" src="../../js/My97DatePicker/WdatePicker.js"></script>
	<script>
	var app = angular.module('myApp', []);
	app.controller('listController', function ($scope, $http) {
	    var reSearch = function () {
	        var postData = {
	            type: 'look',
	            orderid: '<?php echo $orderid;?>',
	        };
	        $http.post('../../Controller/order/listOdrorderAction.php', postData).then(function (result) {  //正确请求成功时处理
	            $scope.list = result.data[0];
	        }).catch(function () { //捕捉错误处理
	            layer.msg('服务端请求错误！', {time: 3000});
	        });
	    }
	    $scope.reSearch = reSearch;
	    $scope.$watch('', reSearch);
	});
	</script>
</body>
</html>