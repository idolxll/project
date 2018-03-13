<?php 
require '../../Common/common.php'; 
include_once '../../../Action/ProductTypeAction.php';
$producttype = new ProductTypeAction();
$result = $producttype->ProducttypeList();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-线路分类</title>
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
			<div class="wbox">
				<div class="wbox-title">
					<h5>产品分类</h5>
					<div class="ibox-tools">
						<a class="btn-blue level-btn" ng-click="addModal()">新增分类</a>
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
									<th width="5%">编号</th>
									<th width="50%" class="text-l">分类名称</th>
									<th width="5%">排序</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($result as $row) {
									if($row["parentid"] == 0){
								?>
								<tr class="text-c">
									<td><?php echo $row["typeid"];?></td>
									<td class="text-l">
										<?php echo $row["typename"];?>
									</td>
									<td><?php echo $row["sn"];?></td>
									<td>
										<a class="btn-blue details-btn" ng-click="addModal('<?php echo $row["typeid"];?>')">添加子分类</a>
										<a class="btn-green revise-btn" ng-click="modifyModal('<?php echo $row["typeid"];?>','<?php echo $row["typename"];?>','<?php echo $row["sn"];?>','<?php echo $row["is_hot"];?>')">修改</a>
										<a class="btn-red goods-delbtn"  ng-click="delModal('<?php echo $row["typeid"];?>')">删除</a>
									</td>
								</tr>
								<?php }
								foreach ($result as $value) {
									if($row["typeid"] == $value["parentid"]){
								?>
								<tr class="text-c">
									<td><?php echo $value["typeid"];?></td>
									<td class="text-l" style="text-indent:40px;">
										|- <?php echo $value["typename"];?>
									</td>
									<td><?php echo $value["sn"];?></td>
									<td>
										<a class="btn-green revise-btn" ng-click="modifyModal('<?php echo $value["typeid"];?>','<?php echo $value["typename"];?>','<?php echo $value["sn"];?>','<?php echo $value["is_hot"];?>')">修改</a>
										<a class="btn-red goods-delbtn"  ng-click="delModal('<?php echo $value["typeid"];?>')">删除</a>
									</td>
								</tr>
								<?php }}}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--新增子分类-->
		<div class="popup add">
			<form class="layui-form">
				<div class="layui-form-item">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入分类名称" class="layui-input addcity" ng-model="typename" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top:10px;">
					<label class="layui-form-label">排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入排序" class="layui-input" ng-model="orderby" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top:10px;">
					<label class="layui-form-label">是否热门</label>
					<div class="layui-input-block" style="width: 65px; margin-left: 80px;">
						<div ng-class="{true: 'will-check active', false: 'will-check'}[is_hot]" class="will-check" style="top: 5px;">
							<input type="checkbox" ng-checked="is_hot" ng-click="changeClass('is_hot')">
							<i class="iconfont"></i>
						</div>
					</div>
				</div>
				<div class="layui-form-item" style="margin-top: 10px;">
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;</label>
					<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="save('add')" value="保存">
					<input type="reset" ng-click="resetData()" class="layui-btn layui-btn-small layui-btn-primary" value="重置" />
				</div>
			</form>
		</div>
		<!--修改-->
		<div class="popup modify">
			<form class="layui-form">
				<div class="layui-form-item">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入分类名称" class="layui-input addcity" ng-model="typename" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top:10px;">
					<label class="layui-form-label">排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入排序" class="layui-input" ng-model="orderby" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top:10px;">
					<label class="layui-form-label">是否热门</label>
					<div class="layui-input-block" style="width: 65px; margin-left: 80px;">
						<div ng-class="{true: 'will-check active', false: 'will-check'}[is_hot]" class="will-check" style="top: 5px;">
							<input type="checkbox" ng-checked="is_hot" ng-click="changeClass('is_hot')">
							<i class="iconfont"></i>
						</div>
					</div>
				</div>
				<div class="layui-form-item" style="margin-top: 10px;">
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;</label>
					<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="save('addchange')" value="保存">
					<input type="reset" ng-click="resetData()" class="layui-btn layui-btn-small layui-btn-primary" value="重置" />
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
	<script type="text/javascript" src="../../js/zhujima.js" ></script>
	<script type="text/javascript" src="../../js/productCategory.js" ></script>
</body>
</html>