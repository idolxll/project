<?php 
require '../../Common/common.php'; 
include_once '../../../Action/ProductTypeAction.php';
$producttype = new ProductTypeAction();
$result = $producttype->ProducttypeList();
$typeid = $_GET["typeid"];
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
</head>
<body  ng-app="myApp">
	<div class="wrapper"  ng-controller="listController">
	<input type="hidden" id="typeid2" value="<?php echo $typeid2;?>">
	<input type="hidden" id="typeid" value="0">
		<div class="content">
			<div class="wbox">
				<div class="wbox-content add-vice">
					<form class="layui-form layui-form-pane">
						<div class="layui-form-item">
							<label class="layui-form-label"><b>*</b>分类名称</label>
							<div class="layui-input-inline" style="width: 278px">
								<input type="text" class="layui-input" id="typename" ng-model="typename" placeholder="请输入副屏标题">
							</div>
						</div>
						<div class="layui-form-item" style="margin-top: 10px;">
							<label class="layui-form-label"><b>*</b>排序</label>
							<div class="layui-input-inline" style="width: 278px">
								<input type="text" class="layui-input" id="orderby" ng-model="orderby" placeholder="请输入副屏展示序号">
							</div>
						</div>
						<div class="layui-form-item" style="margin-top: 10px;">
							<div class="layui-inline">
								<label class="layui-form-label">是否热门</label>
								<div class="layui-input-block" style="width: 65px;  margin-left: 101px;">
									<div ng-class="{true: 'will-check active', false: 'will-check'}[is_hot]" class="will-check">
										<input type="checkbox" ng-checked="is_hot" ng-click="changeClass('is_hot')">
										<i class="iconfont"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="layui-form-item" style="margin-top: 10px;">
                        	<label class="layui-form-label"><b>*</b>副屏图片</label>
                        	<div class="layui-input-block" style="width: 278px;">
                            	<div class="layui-input-inline" style="width: 278px">
                                	<input type="hidden" id="picture2">
                                	<a href="javascript:;" class="choose-book">
                                   	 	<input type="file" id="upload" multiple="" accept="image/jpeg,image/jpg,image/png" />
                                	</a>
                            	</div>
                        	</div>
                    	</div>
						<div class="layui-inline" style="margin-top: 10px;">
							<div class="will-form-file">
								<img id="imglist" src="../../img/img-bg.png" />
								<input type="hidden" id="picture" value="" autocomplete="off">
								<input type="hidden" id="bigpicture" value="" autocomplete="off">
								<input type="button" class="will-file" onclick="upload.click()" value="上传">
								<input class="will-file shang" style="opacity: 0;" type="file" name="file" id="index">
							</div>
						</div>
						<div class="layui-form-item" style="margin-top: 12px;">
							<input type="button" class="layui-btn layui-btn-small layui-btn-normal add-btn" ng-click="save()" value="保存" />
							<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resave()"  value="重置" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js"></script>
	<script type="text/javascript" src="../../js/zhujima.js" ></script>
	<script type="text/javascript" src="../../js/reviceProduct.js"></script>
</body>
</html>