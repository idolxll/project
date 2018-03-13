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
    <title>观世界后台-订单明细</title>
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
					    	<label class="layui-form-label">单号</label>
					    	<div class="layui-input-inline" style="width: 150px;">
					    		<input type="text" ng-model="no" class="layui-input" id="logmin" placeholder="请输入订单号">
					    	</div>
					    </div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">游客姓名</label>
					    	<div class="layui-input-inline" style="width: 110px;">
					        	<input type="text" ng-model="realName" class="layui-input" placeholder="请输入游客姓名">
					    	</div>
					    </div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">游客手机</label>
					    	<div class="layui-input-inline" style="width: 120px;">
					        	<input type="text" ng-model="mobile" class="layui-input" placeholder="请输入游客手机">
					    	</div>
					    </div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">订单状态</label>
					    	<div class="layui-input-inline">
							    <select class="layui-input" ng-model="orderState">
							    	<option value="">请选择...</option>
							    	<option value="0">待支付</option>
                                    <option value="1">已完成</option>
                                    <option value="2">已支付</option>
                                    <option value="3">已取消</option>
                                </select>
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
					    <button class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()">查询</button>
						<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resetSearch()" value="重置" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-title">
					<h5>订单明细</h5>
					<div class="ibox-tools">
						<a class="btn-shuaxin" href="javascript:location.replace(location.href);" title="刷新">
							<i class="iconfont will-shuaxin"></i>
						</a>
					</div>
				</div>
				<div class="wbox-content">
					<div class="con-table">
						<table  class="layui-table" style="min-width: 1200px;">
							<thead>
								<tr class="text-c">
									<th width="10%">单号</th>
									<th width="8%">消费金额</th>
									<th width="8%">预定人姓名</th>
									<th width="8%">联系电话</th>
									<th width="13%">出发时间</th>
									<th width="8%">会员账号</th>
									<th width="8%">订单状态</th>
									<th width="5%">详情</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-c" ng-repeat="item in list" ng-cloak>
									<td>{{item.orderno}}</td>
									<td>￥{{item.totalamount}}</td>
									<td>{{item.realName}}</td>
									<td>{{item.mobile}}</td>
									<td>{{item.createDate}}</td>
									<td>{{item.uname}}</td>
									<td ng-if="item.orderState==0">待确认</td>
									<td ng-if="item.orderState==1">待支付</td>
									<td ng-if="item.orderState==2" class="c-green">已支付</td>
									<td ng-if="item.orderState==3" class="c-red">已取消</td>
									<td ng-if="item.orderState==4" class="c-green">已完成</td>
									<td><a class="check-btn" ng-click="lookModel(item.orderid)">查看</a></td>
								</tr>
							</tbody>
						</table>
					</div>
					<tm-pagination conf="paginationConf"></tm-pagination>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
	<script type="text/javascript" src="../../js/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../../js/orderSumTabel.js"></script>
</body>
</html>