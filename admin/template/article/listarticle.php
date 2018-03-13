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
    <title>观世界后台管理系统-文章列表</title>
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
					    	<label class="layui-form-label">分类</label>
					    	<div class="layui-input-inline">
					    		<select class="layui-input" ng-model="parentid" ng-change="selectType()">
							        <option value="">请选择...</option>
							        <option ng-repeat="item in typelist" ng-cloak ng-value="item.id">{{item.title}}</option>
							    </select>
					    	</div>
					    	<div class="layui-input-inline">
					    		<select class="layui-input" ng-model="typeid">
							        <option value="">请选择...</option>
							        <option ng-repeat="item in Nodelist" ng-cloak ng-value="item.id">{{item.title}}</option>
							    </select>
					    	</div>
						</div>
						<div class="layui-inline">
					    	<label class="layui-form-label">文章标题</label>
					    	<div class="layui-input-inline" style="width: 150px;">
					        	<input type="text" ng-model="title" class="layui-input" placeholder="请输入文章标题">
					    	</div>
					    </div>
					    <input type="button" class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()" value="查询" />
						<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resetSearch()" value="重置" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-title">
					<h5>文章列表</h5>
					<div class="ibox-tools">
						<a class="btn-blue details-btn" ng-click="addModal()">新增文章</a>
						<a class="btn-red del-btn" ng-click="delModal()">删除</a>
						<a class="btn-shuaxin" href="javascript:location.replace(location.href);" title="刷新">
							<i class="iconfont will-shuaxin"></i>
						</a>
					</div>
				</div>
				<div class="wbox-content">
					<div class="con-table">
						<table class="layui-table" style="min-width: 1000px;">
							<thead>
								<tr class="text-c">
									<th width="2%"><input type="checkbox" ng-model="select_all" ng-click="selectAll()"/></th>
									<th width="7%">文章图片</th>
									<th class="text-l" width="28%">标题</th>
									<th width="10%">文章分类</th>
									<th width="5%">排序</th>
									<th width="15%">修改时间</th>
									<th width="10%">操作员</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-c" ng-repeat="item in list" ng-cloak>
									<td><input type="checkbox" ng-model="item.checked" ng-change="selectOne()"/></td>
									<td><a class="details-btn" ng-click="modifyModal(item.id)"><img src="{{item.Smallimg}}" width="60" height="60" ></a></td>
									<td class="text-l"><a class="details-btn" ng-click="modifyModal(item.id)">{{item.title}}</a></td>
									<td>{{item.typename}}</td>
									<td>{{item.orderby}}</td>
									<td>{{item.modifyDate}}</td>
									<td>{{item.createName}}</td>
									<td>
										<a class="btn-green revise-btn" ng-click="modifyModal(item.id)">修改</a>
										<a class="btn-red goods-delbtn" ng-click="delModal(item.id)">删除</a>
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
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js"></script>
	<script type="text/javascript" src="../../js/listarticle.js"></script>
</body>
</html>