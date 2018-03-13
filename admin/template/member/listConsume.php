<?php 
require '../../Common/common.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-消费列表</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../css/will.css" />
    <script charset="utf-8" src="../../js/angular.min.js"></script>
    <script src="../../js/tmpagination/tm.pagination.js"></script>
</head>
<body ng-app="myApp">
	<div class="wrapper" ng-controller="listController">
		<div class="content">
			<div class="wboxform">
				<form class="layui-form">
					<div class="layui-form-item">
					    <div class="layui-inline">
					    	<label class="layui-form-label">会员姓名</label>
					    	<div class="layui-input-inline" style="width: 110px;">
					        	<input type="text" ng-model="realName" class="layui-input" placeholder="请输入会员姓名">
					    	</div>
					    </div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">会员手机</label>
					    	<div class="layui-input-inline" style="width: 120px;">
					        	<input type="text" ng-model="mobile" class="layui-input" placeholder="请输入会员手机">
					    	</div>
					    </div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">时间</label>
					    	<div class="layui-input-inline" style="width: 156px;">
					    		<input type="text" class="Wdate layui-input" ng-model="startDate" onchange="" id="logmin" placeholder="请选择..."  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})">
					    	</div>
					    	<div class="layui-form-mid">-</div>
					    	<div class="layui-input-inline" style="width: 156px;">
					    		<input type="text" class="Wdate layui-input" ng-model="endDate" onchange="" id="logmax" placeholder="请选择..." onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})">
					    	</div>
					    </div>
					    <!--<div class="layui-inline">
					    	<label class="layui-form-label">消费门店</label>
					    	<div class="layui-input-inline">
					    		<select class="layui-input">
							        <option value="0">请选择...</option>
							        <option value="1">汇汇生活品牌店</option>
							        <option value="2">桂香美食</option>
							    </select>
					    	</div>
					    </div> -->
					    <input type="button" class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()" value="查询" />
						<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resetSearch()" value="重置" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-title">
					<h5>消费列表</h5>
					<div class="ibox-tools">
						<a class="btn-shuaxin" href="javascript:location.replace(location.href);" title="刷新">
							<i class="iconfont will-shuaxin"></i>
						</a>
					</div>
				</div>
				<div class="wbox-content">
					<div class="con-table">
						<table  class="layui-table" style="min-width: 1100px;">
							<thead>
								<tr class="text-c">
									<th width="16%">单号</th>
									<th width="8%">姓名</th>
									<th width="10%">手机号码</th>
									<th width="10%">支付金额</th>
									<th width="15%">时间</th>
									<th class="text-l">消费产品</th>
									<th width="7%">明细</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-c" ng-repeat="item in list" ng-cloak>
									<td>{{item.orderno}}</td>
									<td>{{item.realName}}</td>
									<td>{{item.mobile}}</td>
									<td>{{item.totalamount}}</td>
									<td>{{item.createDate}}</td>
									<td class="text-l">{{item.productname}}</td>
									<td>
										<a class="btn-blue view-btn" ng-click="lookModel(item.orderid)">查看</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<tm-pagination conf="paginationConf"></tm-pagination>
				</div>
			</div>
		</div>
	</div>
	<!--查看购买明细-->
	<div class="popup view-open">
		<div class="popup-body">
			<p><span>单号：</span>{{info.orderno}}</p>
			<p><span>时间：</span>{{info.createDate}}</p>
			<p><span>游客姓名：</span>{{info.displayname}}</p>
			<p><span>游客手机：</span>{{info.mobile}}</p>
			<p ng-if="info.orderType==1"><span>消费方式：</span>微信支付</p>
			<p ng-if="info.orderType==2"><span>消费方式：</span>支付宝</p>
			<p ng-if="info.orderType==1"><span>消费方式：</span>账户余额</p>
			<p><span>消费产品：</span>{{info.productname}}</p>
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
			<p><span>实付金额：</span>￥{{info.totalamount}}</p>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
	<script type="text/javascript" src="../../js/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../../js/listConsume.js"></script>
</body>
</html>