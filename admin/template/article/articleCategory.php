<?php 
require '../../Common/common.php'; 
include_once '../../../Action/Article_categoryAction.php';
$article_category = new Article_categoryAction();
$result = $article_category->ArticleTypeList();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-文章分类</title>
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
					<h5>文章分类</h5>
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
									<td><?php echo $row["id"];?></td>
									<td class="text-l">
										<?php echo $row["title"];?>
									</td>
									<td><?php echo $row["sn"];?></td>
									<td>
										<a class="btn-blue details-btn" ng-click="addModal('<?php echo $row["id"];?>')">添加子分类</a>
										<a class="btn-green revise-btn" ng-click="modifyModal('<?php echo $row["id"];?>','<?php echo $row["title"];?>','<?php echo $row["sn"];?>','<?php echo $row["is_hot"];?>')">修改</a>
										<a class="btn-red goods-delbtn"  ng-click="delModal('<?php echo $row["id"];?>')">删除</a>
									</td>
								</tr>
								<?php }
								foreach ($result as $value) {
									if($row["id"] == $value["parentid"]){
								?>
								<tr class="text-c">
									<td><?php echo $value["id"];?></td>
									<td class="text-l" style="text-indent:40px;">
										|- <?php echo $value["title"];?>
									</td>
									<td><?php echo $value["sn"];?></td>
									<td>
										<a class="btn-green revise-btn" ng-click="modifyModal('<?php echo $value["id"];?>','<?php echo $value["title"];?>','<?php echo $value["sn"];?>')">修改</a>
										<a class="btn-red goods-delbtn"  ng-click="delModal('<?php echo $value["id"];?>')">删除</a>
									</td>
								</tr>
								<?php }}}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--修改分类-->
		<div class="popup modify">
			<form class="layui-form">
				<div class="layui-form-item">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入分类名称" class="layui-input" ng-model="typename" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top:10px;">
					<label class="layui-form-label">排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入排序" class="layui-input" ng-model="sn" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top: 10px;">
					<input type="hidden" ng-model="typeid" />
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;</label>
					<input type="button" ng-disabled="but" ng-di class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="save('modify')" value="保存">
					<input type="reset" ng-click="resetData()" class="layui-btn layui-btn-small layui-btn-primary" value="重置" />
				</div>
			</form>
		</div>
		<!--新增分类-->
		<div class="popup add">
			<form class="layui-form">
				<div class="layui-form-item">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入分类名称" class="layui-input" ng-model="typename" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top:10px;">
					<label class="layui-form-label">排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序</label>
					<div class="layui-input-inline" style="width: 210px;">
						<input name="title" placeholder="请输入排序" class="layui-input" ng-model="sn" type="text">
					</div>
				</div>
				<div class="layui-form-item" style="margin-top: 10px;">
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;</label>
					<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="save('add')" value="保存">
					<input type="reset" ng-click="resetData()" class="layui-btn layui-btn-small layui-btn-primary" value="重置" />
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
	<script type="text/javascript" src="../../js/articleCategory.js" ></script>
</body>
</html>