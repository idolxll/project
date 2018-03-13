<?php 
require '../../Common/common.php'; 
$owneruid = $_GET["owneruid"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-我的下级</title>
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
	<input type="hidden" ng-model="owneruid" ng-init="owneruid='<?php echo $owneruid;?>'" />
		<div class="content">
			<div class="wboxform">
				<form class="layui-form">
					<div class="layui-form-item">
					    <div class="layui-inline">
					    	<label class="layui-form-label">姓名</label>
					    	<div class="layui-input-inline" style="width: 156px;">
					    		<input type="text" class="layui-input" ng-model="realName" placeholder="请输入姓名" />
					    	</div>
					    	<label class="layui-form-label">手机号</label>
					    	<div class="layui-input-inline" style="width: 156px;">
					    		<input type="text" class="layui-input" ng-model="mobile" placeholder="请输入手机号码" />
					    	</div>
					    </div>
					    <input type="button" class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()" value="查询" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-content">
					<div class="con-table">
						<table class="layui-table">
							<thead>
								<tr class="text-c">
									<th>姓名</th>
									<th width="32%">会员类型</th>
									<th width="32%">余额</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-c" ng-repeat="item in list" ng-cloak>
									<td>{{item.realName}}</td>
									<td ng-if="item.vip==0 || item.vip==''">普通会员</td>
									<td ng-if="item.vip==1" class="c-red">一级分销商</td>
									<td ng-if="item.vip==2" class="c-green">二级分销商</td>
									<td ng-if="item.vip==3" class="c-green">三级分销商</td>
									<td>￥{{item.totalamount ? item.totalamount : 0}}</td>
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
	<script type="text/javascript" src="../../js/subMember.js"></script>
</body>
</html>