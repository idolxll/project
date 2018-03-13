<?php 
require '../../Common/common.php'; 
include_once '../../../Action/ProductAction.php';
include_once '../../../Action/ProductpriceitemsAction.php';
include_once '../../../Action/ProductdetailAction.php';
$product = new ProductAction();
$productpriceitems = new ProductpriceitemsAction();
$productdetail = new ProductdetailAction();
$productid = $_GET["productid"];
$model = $product->getProductInfo($productid);
//file_put_contents("log.txt", "model信息：".var_export($model,TRUE)."\n", FILE_APPEND);
$pricelist = $productpriceitems->getPriceList($productid);
$detaillist = $productdetail->getProductdetail($productid);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-线路编辑</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="../../css/will.css" />
    <link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="../../js/angular.min.js"></script>
	<script charset="utf-8" src="../../kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="../../kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="../../kindeditor/plugins/code/prettify.js"></script>
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script>
	var productname = '<?php echo $model[0]["productname"]?>';
	var productno = '<?php echo $model[0]["productno"]?>';
	var parentid = '<?php echo $model[0]["parentid"]?>';
	var typeid = '<?php echo $model[0]["typeid"]?>';
	var img = '<?php echo $model[0]["img"] ? $model[0]["img"] : '../../img/img-bg.png'?>';
	var Smallimg = '<?php echo $model[0]["thumbnail"] ? $model[0]["thumbnail"] : '../../img/img-bg.png'?>';
	var status = '<?php echo $model[0]["status"]?>';
	var is_top = '<?php echo $model[0]["is_top"]?>';
	var is_red = '<?php echo $model[0]["is_red"]?>';
	var is_hot = '<?php echo $model[0]["is_hot"]?>';
	var price = '<?php echo $model[0]["price"]?>';
	var market = '<?php echo $model[0]["market"]?>';
	var Share_amount = '<?php echo $model[0]["Share_amount"]?>';
	var sales = '<?php echo $model[0]["sales"]?>';
	var xcdays = '<?php echo $model[0]["xcdays"]?>';
	var jtfs = '<?php echo $model[0]["jtfs"]?>';
	var ftfs = '<?php echo $model[0]["ftfs"]?>';
	var seo_title = '<?php echo $model[0]["seo_title"]?>';
	var seo_keywords = '<?php echo $model[0]["seo_keywords"]?>';
	var seo_description = '<?php echo $model[0]["seo_description"]?>';
	var count = <?php echo count($detaillist);?>;
	var sn = '<?php echo $model[0]["sn"]?>';
	var type = '<?php echo $model[0]["type"];?>';
	var month = '<?php echo $model[0]["month"];?>';
	$(document).ready(function () {
		editorinit();
	});
	function editorinit() {
		for(var i = 0; i<count; i++){
			KindEditor.create('#lineday' + i, {
		        width: '95%',
		        height: '260px',
		        resizeType: 1,
		        allowFileManager: true,
		        allowPreviewEmoticons: false,
		        allowImageUpload: true,
		        cssPath : '../../kindeditor/plugins/code/prettify.css',
				uploadJson : '../../kindeditor/php/upload_json.php',
				fileManagerJson : '../../kindeditor/php/file_manager_json.php',
				afterBlur: function () {
	                this.sync();
	            },
	            afterCreate: function () {
	                this.sync();
	            }
		    });
		}
		//初始化编辑器
	    var description = KindEditor.create("#description", {
	        width: '98%',
	        height: '260px',
	        resizeType: 1,
	        allowFileManager: true,
	        allowPreviewEmoticons: false,
	        allowImageUpload: true,
	        cssPath : '../../kindeditor/plugins/code/prettify.css',
			uploadJson : '../../kindeditor/php/upload_json.php',
			fileManagerJson : '../../kindeditor/php/file_manager_json.php',
			afterBlur: function () {
                this.sync();
            },
            afterCreate: function () {
                this.sync();
            }
	    });
	    var xcts = KindEditor.create("#xcts", {
	        width: '98%',
	        height: '260px',
	        resizeType: 1,
	        allowFileManager: true,
	        allowPreviewEmoticons: false,
	        allowImageUpload: true,
	        cssPath : '../../kindeditor/plugins/code/prettify.css',
			uploadJson : '../../kindeditor/php/upload_json.php',
			fileManagerJson : '../../kindeditor/php/file_manager_json.php',
			afterBlur: function () {
                this.sync();
            },
            afterCreate: function () {
                this.sync();
            }
	    });
	    var instructions = KindEditor.create("#instructions", {
	        width: '98%',
	        height: '260px',
	        resizeType: 1,
	        allowFileManager: true,
	        allowPreviewEmoticons: false,
	        allowImageUpload: true,
	        cssPath : '../../kindeditor/plugins/code/prettify.css',
			uploadJson : '../../kindeditor/php/upload_json.php',
			fileManagerJson : '../../kindeditor/php/file_manager_json.php',
			afterBlur: function () {
                this.sync();
            },
            afterCreate: function () {
                this.sync();
            }
	    });
	    prettyPrint();
	}
	</script>
</head>
<body ng-app="myApp">
	<div class="wrapper" ng-controller="listController">
		<input type="hidden" id="productid" value="<?php echo $_GET["productid"];?>">
		<div class="content">
			<div class="wbox goods-combo">
				<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
					<ul class="layui-tab-title">
				    	<li class="layui-this">基本信息</li>
				    	<li>详情描述</li>
				    	<li>线路信息</li>
				    	<li>价格</li>
				    	<li>SEO选项</li>
					</ul>
					<div class="layui-tab-content article-goods">
						<!--基本信息开始-->
				    	<div class="layui-tab-item layui-show">
				    		<form class="layui-form layui-form-pane">
					    		<div class="layui-tab-content article-goods">
					    			<div class="layui-form-item">
						    			<div class="layui-inline">
							    			<div class="layui-form-item">
							    				<div class="layui-inline">
							    					<label class="layui-form-label"><b>*</b>产品名称</label>
													<div class="layui-input-inline" style="width: 450px;">
														<input type="text" ng-model="productname" class="layui-input" placeholder="请输入线路名称">
													</div>
							    				</div>
							    			</div>
							    			<div class="layui-form-item" style="margin-top: 10px;">
							    				<div class="layui-inline">
							    					<label class="layui-form-label"><b>*</b>产品编号</label>
													<div class="layui-input-inline" style="width: 450px;">
														<input type="text" value="<?php echo $model[0]["productno"] ? $model[0]["productno"] : rand(1000000,99999999);?>" id="productno" class="layui-input" placeholder="请输入线路编号">
													</div>
							    				</div>
							    			</div>
						    			</div>
						    			<div class="layui-inline">
											<div class="will-form-file">
												<img id="imglist" src="../../img/img-bg.png" />
												<input type="hidden" id="picture" value="" autocomplete="off">
												<input type="hidden" id="bigpicture" value="" autocomplete="off">
												<input type="button" class="will-file" onclick="upload.click()" value="上传">
												<input class="will-file shang" style="opacity: 0;" type="file" name="file" id="index">
											</div>
						    			</div>
					    			</div>
					    			<div class="layui-form-item" style="margin-top: 10px;">
					    				<div class="layui-inline">
					    					<label class="layui-form-label"><b>*</b>产品分类</label>
					    					<div class="layui-input-inline" style="width: 324px;">
						    					<select class="layui-select" ng-model="parentid" ng-change="selectType()">
													<option value="" selected="selected">请选择产品分类...</option>
													<option ng-repeat="item in list" ng-cloak ng-value="item.typeid">{{item.typename}}</option>
												</select>
											</div>
					    				</div>
					    				<div class="layui-inline">
					    					<div class="layui-input-inline" style="width: 324px;">
						    					<select class="layui-select ng-pristine ng-valid ng-empty ng-touched" ng-model="typeid">
													<option value="" selected="selected">请选择产品分类...</option>
													<option ng-repeat="item in Nodelist" ng-cloak ng-value="item.typeid">{{item.typename}}</option>
												</select>
											</div>
					    				</div>
					    			</div>
					    			<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff;background-color: #FBFBFB;line-height: 20px;border: 1px solid #e6e6e6;border-radius: 2px 0 0 2px;top: 27px;">推荐理由</label>
											<div class="layui-input-inline" style="width: 90%;">
												<textarea name="recommend" id="recommend" style="width: 45%;height:100px;border: 1px solid #e6e6e6;color: #666;padding: 5px;" class="ng-pristine ng-valid ng-empty ng-touched"><?php echo $model[0]["recommend"];?></textarea>
											</div>
										</div>
						    		</div>
					    			<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline">
											<label class="layui-form-label" style="width: 80px;">是否上架</label>
											<div class="layui-input-block" style="width: 65px; margin-left: 80px;">
												<div ng-class="{true: 'will-check active', false: 'will-check'}[status]">
													<input type="checkbox" ng-checked="status" ng-click="changeClass('status')">
													<i class="iconfont"></i>
												</div>
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label" style="width: 80px;">是否置顶</label>
											<div class="layui-input-block" style="width: 65px;  margin-left: 80px;">
												<div ng-class="{true: 'will-check active', false: 'will-check'}[is_top]">
													<input type="checkbox" ng-checked="is_top" ng-click="changeClass('is_top')">
													<i class="iconfont"></i>
												</div>
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label" style="width: 80px;">是否推荐</label>
											<div class="layui-input-block" style="width: 65px; margin-left: 80px;">
												<div ng-class="{true: 'will-check active', false: 'will-check'}[is_red]">
													<input type="checkbox" ng-checked="is_red" ng-click="changeClass('is_red')">
													<i class="iconfont"></i>
												</div>
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label" style="width: 80px;">是否热门</label>
											<div class="layui-input-block" style="width: 65px; margin-left: 80px;">
												<div ng-class="{true: 'will-check active', false: 'will-check'}[is_hot]">
													<input type="checkbox" ng-checked="is_hot" ng-click="changeClass('is_hot')">
													<i class="iconfont"></i>
												</div>
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label" style="width: 50px;">排序</label>
											<div class="layui-input-inline" style="width: 98px;">
												<input type="text" class="layui-input" ng-model="sn" placeholder="数值小的在前">
											</div>
										</div>
									</div>
									<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline">
											<label class="layui-form-label"><b>*</b>会员价格</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="price" placeholder="输入会员价格" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label"><b>*</b>市场价格</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="market" placeholder="输入市场价格" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label"><b>*</b>分润金额</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="Share_amount" placeholder="输入分润金额" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label">线路销量</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="sales" placeholder="输入线路销量" />
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
						    			<div class="layui-inline">
											<label class="layui-form-label"  style="padding: 8px 1px;">适合出行月份</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="month" placeholder="" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label"><b>*</b>行程天数</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="xcdays" placeholder="输入行程天数" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label">发团方式</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="ftfs" placeholder="输入发团方式" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label">交通方式</label>
											<div class="layui-input-inline" style="width: 90px;">
												<input type="text" class="layui-input" ng-model="jtfs" placeholder="输入交通方式" />
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
						    			<div class="layui-inline">
											<label class="layui-form-label" style="top: 24px;    text-align: center;">图片集</label>
											<span id="listimg" style="margin-left: 10px;">
											<?php 
												$imglist = explode(",", $model[0]["imglist"]);
												if(!empty($model[0]["imglist"])){
												for($i = 0; $i< count($imglist); $i++){?>
												<div class="will-form-file" style="margin-left: 10px;">
													<img src="<?php echo $imglist[$i];?>" />
												</div>	
												<?php }}?>
											</span>
											<div class="will-form-file" style="margin-left: 10px;">
												<img src="../../img/img-bg.png" />
												<input type="hidden" id="picturestr" value="<?php echo $model[0]["imglist"]?>" autocomplete="off">
												<input type="button" class="will-file" onclick="upload.click()" value="上传" style="height: 76px;">
												<input class="will-file shang" style="opacity: 0;height: 76px;" multiple="true" type="file" name="images[]" id="moreimg">
											</div>
										</div>
						    		</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
										<?php if(empty($productid)){?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="保存" ng-click="save('add')" />
										<?php }else{?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="修改" ng-click="save('modify')" />
										<?php }?>
										<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" value="重置" ng-click="resave()" />
									</div>
					    		</div>
				    		</form>
				    	</div>
				    	<!--基本信息结束-->
				    	<!--详情描述开始-->
				    	<div class="layui-tab-item">
				    		<form class="layui-form layui-form-pane">
					    		<div class="layui-tab-content article-goods">
					    			<div class="layui-form-item">
						    			<div class="layui-inline" style="width: 100%;">
							    			<div class="layui-form-item">
							    				<div class="layui-inline" style="width: 100%;">
							    					<label class="layui-form-label" style="border: 0;background-color: #fff;"><b>*</b>费用说明</label>
													<div class="layui-input-inline" style="width: 89%;">
														<textarea name="description" id="description" style="width:700px;height:200px;visibility:hidden;" rows="8"><?php echo $model[0]["description"];?></textarea>
													</div>
							    				</div>
							    			</div>
						    			</div>
						    			<div class="layui-inline" style="width: 100%;margin-top: 10px;">
							    			<div class="layui-form-item">
							    				<div class="layui-inline" style="width: 100%;">
							    					<label class="layui-form-label" style="border: 0;background-color: #fff;"><b>*</b><span id="tips1">产品特色</span></label>
													<div class="layui-input-inline" style="width: 89%;">
														<textarea name="xcts" id="xcts" style="width:700px;height:200px;visibility:hidden;" rows="8"><?php echo $model[0]["xcts"];?></textarea>
													</div>
							    				</div>
							    			</div>
						    			</div>
						    			<div class="layui-inline" style="width: 100%;margin-top: 10px;">
							    			<div class="layui-form-item">
							    				<div class="layui-inline" style="width: 100%;">
							    					<label class="layui-form-label" style="border: 0;background-color: #fff;"><b>*</b>预定须知</label>
													<div class="layui-input-inline" style="width: 89%;">
														<textarea name="instructions" id="instructions" style="width:700px;height:200px;visibility:hidden;" rows="8"><?php echo $model[0]["instructions"];?></textarea>
													</div>
							    				</div>
							    			</div>
						    			</div>
					    			</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
										<?php if(empty($productid)){?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="保存" ng-click="save('add')" />
										<?php }else{?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="修改" ng-click="save('modify')" />
										<?php }?>
									</div>
					    		</div>
							</form>
				    	</div>
				    	<!--详情描述结束-->
				    	<!--线路信息开始-->
				    	<div class="layui-tab-item">
				    		<div class="combo-list">
					    		<?php 
					    		foreach ($detaillist as $key => $row){?>
					    		<input id="detailid<?php echo $key?>" name="detailid<?php echo $key?>" type="hidden" value="<?php echo $row["id"];?>" />
					    		<div class="combo-item" id="list<?php echo $key+1?>">
									<div class="layui-form-item" style="margin-bottom: 10px;">
										<label class="layui-form-label">行程标题</label>
										<div class="layui-input-inline" style="width: 400px;">
											<input type="text" class="layui-input" id="linedaytitle<?php echo $key?>" value="<?php echo $row["title"];?>" placeholder="请输入标题" autocomplete="off">
										</div>
									</div>
									<div class="layui-form-item" style="margin-bottom: 10px;">
										<div class="layui-inline"><label class="layui-form-label">行程概要</label>
											<div class="layui-input-inline" style="width: 400px;">
												<input type="text" class="layui-input" id="linetitle<?php echo $key?>" value="<?php echo $row["outline"];?>" placeholder="请输入行程概要">
											</div>
										</div>
									</div>
									<div class="con-table"><label class="layui-form-label">
										第&nbsp; <?php echo $row["day"];?>&nbsp;天&nbsp;&nbsp;</label>
										<textarea name="lineday<?php echo $key?>" id="lineday<?php echo $key?>" style="width:700px;height:200px;visibility:hidden;" rows="8"><?php echo $row["description"];?></textarea>
									</div>
								</div>
					    		<?php }?>
						 	</div>
						 	<div class="layui-form-item tab-btn" style="margin: 12px 0;">
								<a class="add-tab"  ng-click="adddaytr(true)" ng-hide="addNum"><i class="iconfont will-jia"></i>新增出游天数</a>
								<a class="del-tab"  ng-click="adddaytr(false)"  ng-hide="reduceNum"><i class="iconfont will-desc"></i>删除</a>
							</div>
							<div class="layui-form-item" style="margin-top: 15px;">
								<?php if(empty($productid)){?>
								<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="保存" ng-click="save('add')" />
								<?php }else{?>
								<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="修改" ng-click="save('modify')" />
								<?php }?>
							</div>
						 </div>
				    	<!--线路信息结束-->
				    	<!--价格开始-->
				    	<div class="layui-tab-item">
				    		<form class="layui-form layui-form-pane" id="datalist">
					    		<div class="layui-tab-content article-goods" style=" padding: 0;border-top:0">
					    			<div class="layui-form-item">
										<div class="layui-inline">
											<label class="layui-form-label">出游时间</label>
											<div class="layui-input-inline" style="width: 120px;">
												<input type="text" id="startdate" class="Wdate layui-input" onchange="" ng-model="starttime" ng-init="starttime='<?php echo date("Y-m-d",time());?>'" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" placeholder="开始时间"/>
											</div>
											<div class="layui-input-inline" style="width: 120px;">
												<input type="text" id="enddate" class="Wdate layui-input" onchange="" ng-model="endtime" ng-init="endtime='<?php echo date("Y-m-d", strtotime("+1 months", strtotime(date("Y-m-d",time()))));?>'" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" placeholder="结束时间"/>
											</div>
											<label class="layui-form-label">会员价格</label>
											<div class="layui-input-inline" style="width: 120px;">
												<input type="text" id="money" ng-model="money" class="layui-input" placeholder=""/>
											</div>
											<label class="layui-form-label">市场价格</label>
											<div class="layui-input-inline" style="width: 120px;">
												<input type="text" id="money1" ng-model="money1" class="layui-input" placeholder=""/>
											</div>
											<div class="layui-input-block layui-check-block" style="width: 86px; padding: 0;">
										    	<label>
													<input type="button" class="combo-check" style="color: #fff;
												    background-color: #1E9FFF;
												    border: 0;
												    width: 100%;
												    height: 100%;" value="确认" onclick="adddaterows();" />
												</label>
											</div>
										</div>
										<div class="wbox-content" style="margin-top:10px; padding: 0;border-top:0">
											<div class="con-table">
												<table class="layui-table">
													<thead>
														<tr class="text-c">
															<th width="20%">日期</th>
															<th width="20%">会员价格</th>
															<th width="20%">市场价格</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody id="list">
													<?php 
													foreach ($pricelist as $row){?>
														<tr>
															<td align="center">
															<input id="date<?php echo $row["date"];?>" name="date" type="text" value="<?php echo $row["date"];?>" class="textbox" size="12" onclick='WdatePicker({dateFmt:"yyyy-MM-dd"})' />
															<input id="rowid" name="rowid" type="hidden" value="<?php echo $row["id"];?>" />
															</td>
															<td align="center">
															￥<input id="aduit_price<?php echo $row["date"];?>" name="aduit_price" type="text" class="textbox" size="8" value="<?php echo $row["aduit_price"];?>"/>
															</td>
															<td align="center">
															￥<input id="market_aduitprice<?php echo $row["date"];?>" name="market_aduitprice" type="text" class="textbox" size="8" value="<?php echo $row["market_aduitprice"];?>"/>
															</td>
															<td align="center" width="80">
															<a href="javascript:void(0);" onclick="deldaterow(this,'<?php echo $row["date"];?>');">删除</a>
															</td>
														</tr>
													<?php }?>
													</tbody>
												</table>
											</div>
										</div>
							    	</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
					    				<?php if(empty($productid)){?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="保存" ng-click="save('add')" />
										<?php }else{?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="修改" ng-click="save('modify')" />
										<?php }?>
									</div>
					    		</div>
							</form>
				    	</div>
				    	<!--价格结束-->
				    	<!--SEO选项开始-->
				    	<div class="layui-tab-item">
				    		<form class="layui-form layui-form-pane">
					    		<div class="layui-tab-content article-goods">
					    			<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff;">SEO标题</label>
											<div class="layui-input-inline" style="width: 89.8%;">
												<input type="text" name="seo_title" ng-model="seo_title" class="layui-input" placeholder="请输入SEO标题" />
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff; width:90px;">SEO关健字</label>
											<div class="layui-input-inline" style="width: 89%;">
												<textarea name="seo_keywords" ng-model="seo_keywords" style="width:100%;height:100px;border: 1px solid #e6e6e6;color: #666;padding: 5px;"></textarea>
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff;">SEO描述</label>
											<div class="layui-input-inline" style="width: 89%;">
												<textarea name="seo_description" ng-model="seo_description" style="width:100%;height:100px;border: 1px solid #e6e6e6;color: #666;padding: 5px;"></textarea>
											</div>
										</div>
						    		</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
										<?php if(empty($productid)){?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="保存" ng-click="save('add')" />
										<?php }else{?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="修改" ng-click="save('modify')" />
										<?php }?>
										<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" value="重置" ng-click="resave()" />
									</div>
					    		</div>
							</form>
				    	</div>
				    	<!--SEO选项结束-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../../js/jquery.form.min.js"></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js"></script>
	<script type="text/javascript" src="../../js/layui.js"></script>
	<script type="text/javascript" src="../../js/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../../js/detailsProduct.js"></script>
</body>
</html>