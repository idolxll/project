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
    <title>观世界后台-会员列表</title>
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
					    <input type="button" class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()" value="查询" />
						<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resetSearch()" value="重置" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-title">
					<h5>会员列表</h5>
					<div class="ibox-tools">
						<a class="btn-shuaxin" href="javascript:location.replace(location.href);" title="刷新">
							<i class="iconfont will-shuaxin"></i>
						</a>
					</div>
				</div>
				<div class="wbox-content">
					<div class="con-table">
						<table class="layui-table" style="min-width: 1280px;">
							<thead>
								<tr class="text-c">
									<th width="20%">操作</th>
									<th width="6%">资金记录</th>
									<th width="9%">姓名</th>
									<th width="9%">昵称</th>
									<th width="5%">性别</th>
									<th width="8%">手机号码</th>
									<th width="8%">会员类型</th>
									<th width="9%">余额</th>
									<th width="7%">消费总金额</th>
									<th width="7%">消费总次数</th>
									<th width="16%">最后消费时间</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-c" ng-repeat="item in list" ng-cloak>
									<td ng-if="item.status==0">
										<a class="btn-red hyzx-btn" ng-click="Logout(item.uid)">注销</a>&nbsp;&nbsp;
										<a class="btn-red hyzx-btn" ng-click="look(item.uid)">我的下级</a>&nbsp;&nbsp;
										<a ng-if="item.vip!=1" class="btn-red hyzx-btn" ng-click="upgrade(item.uid,item.realName)">成为一级分销</a>
									</td>
									<td ng-if="item.status==1" class="c-green">已注销</td>
									<td><a class="check-btn" ng-click="searchRecord(item.uid)">查看</a></td>
									<td>{{item.realName}}</td>
									<td>{{item.nickname}}</td>
									<td ng-if="item.sex==0">保密</td>
									<td ng-if="item.sex==1">男</td>
									<td ng-if="item.sex==2">女</td>
									<td>{{item.mobile}}</td>
									<td ng-if="item.vip==0 || item.vip==''">普通会员</td>
									<td ng-if="item.vip==1" class="c-red">一级分销商</td>
									<td ng-if="item.vip==2" class="c-green">二级分销商</td>
									<td ng-if="item.vip==3" class="c-green">三级分销商</td>
									<td>￥{{item.totalamount ? item.totalamount : 0}}</td>
									<td>￥{{item.totalmoney}}</td>
									<td>{{item.count}}</td>
									<td>{{item.datatime}}</td>
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
	<script type="text/javascript" src="../../js/listMember.js"></script>
</body>
</html>