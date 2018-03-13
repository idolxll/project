<?php 
require '../../Common/common.php'; 
include_once '../../../Action/ArticleAction.php';
$article = new ArticleAction();
$id = $_GET["id"];
$model = $article->getArticleInfo($id);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台-文章编辑</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="../../css/will.css" />
    <link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="../../kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="../../kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="../../kindeditor/plugins/code/prettify.js"></script>
	<script charset="utf-8" src="../../js/angular.min.js"></script>
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script>
	var title = '<?php echo $model[0]["title"]?>';
	var call_index = '<?php echo $model[0]["call_index"]?>';
	var parentid = '<?php echo $model[0]["parentid"]?>';
	var category_id = '<?php echo $model[0]["category_id"]?>';
	var img_url = '<?php echo $model[0]["img_url"]?>';
	var Smallimg = '<?php echo $model[0]["Smallimg"]?>';
	var is_slide = '<?php echo $model[0]["is_slide"]?>';
	var is_top = '<?php echo $model[0]["is_top"]?>';
	var is_red = '<?php echo $model[0]["is_red"]?>';
	var is_hot = '<?php echo $model[0]["is_hot"]?>';
	var orderby = '<?php echo $model[0]["orderby"]?>';
	var link_url = '<?php echo $model[0]["link_url"]?>';
	var zhaiyao = '<?php echo $model[0]["abstract"]?>';
	var click = '<?php echo $model[0]["click"]?>';
	var seo_title = '<?php echo $model[0]["seo_title"]?>';
	var seo_keywords = '<?php echo $model[0]["seo_keywords"]?>';
	var seo_description = '<?php echo $model[0]["seo_description"]?>';
	var address = '<?php echo $model[0]["address"]?>';
	var zan = '<?php echo $model[0]["zan"]?>';
	$(document).ready(function () {
		editorinit();
	});
	function editorinit() {
		//初始化编辑器
	    var description = KindEditor.create("#content", {
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
		<input type="hidden" id="id" value="<?php echo $_GET["id"];?>">
		<div class="content">
			<div class="wbox goods-combo">
				<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
					<ul class="layui-tab-title">
				    	<li class="layui-this">基本信息</li>
				    	<li>详情描述</li>
				    	<li>SEO选项</li>
					</ul>
					<div class="layui-tab-content article-goods">
						<!--基本信息开始-->
				    	<div class="layui-tab-item layui-show">
				    		<form class="layui-form layui-form-pane">
					    		<div class="wbox-content article-goods">
					    			<div class="layui-form-item">
						    			<div class="layui-inline">
							    			<div class="layui-form-item">
							    				<div class="layui-inline">
							    					<label class="layui-form-label"><b>*</b>文章标题</label>
													<div class="layui-input-inline" style="width: 450px;">
														<input type="text" ng-model="title" class="layui-input" placeholder="请输入文章标题">
													</div>
							    				</div>
							    			</div>
							    			<div class="layui-form-item" style="margin-top: 10px;">
							    				<div class="layui-inline">
							    					<label class="layui-form-label">调用别名</label>
													<div class="layui-input-inline" style="width: 450px;">
														<input type="text" ng-model="call_index" class="layui-input" placeholder="请输入调用别名">
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
					    					<label class="layui-form-label"><b>*</b>文章分类</label>
					    					<div class="layui-input-inline" style="width: 318px;">
						    					<select class="layui-select ng-pristine ng-valid ng-empty ng-touched" ng-model="parentid" ng-change="selectType()">
													<option value="" selected="selected">请选择文章分类...</option>
													<option ng-repeat="item in list" ng-cloak ng-value="item.id">{{item.title}}</option>
												</select>
											</div>
					    				</div>
					    				<div class="layui-inline">
					    					<div class="layui-input-inline" style="width: 317px;">
						    					<select class="layui-select ng-pristine ng-valid ng-empty ng-touched" ng-model="category_id">
													<option value="" selected="selected">请选择文章分类...</option>
													<option ng-repeat="item in Nodelist" ng-cloak ng-value="item.id">{{item.title}}</option>
												</select>
											</div>
					    				</div>
					    			</div>
					    			<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline">
											<label class="layui-form-label" style="width: 80px;">是否幻灯片</label>
											<div class="layui-input-block" style="width: 65px; margin-left: 80px;">
												<div ng-class="{true: 'will-check active', false: 'will-check'}[is_slide]">
													<input type="checkbox" ng-checked="is_slide" ng-click="changeClass('is_slide')">
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
											<div class="layui-input-inline" style="width: 96px;">
												<input type="text" class="layui-input" ng-model="orderby" placeholder="数值小的在前">
											</div>
										</div>
									</div>
									<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline">
											<label class="layui-form-label">外部链接</label>
											<div class="layui-input-inline" style="width: 430px;">
												<input type="text" class="layui-input" ng-model="link_url" placeholder="请输入外部链接" />
											</div>
										</div>
										<div class="layui-inline">
											<label class="layui-form-label">浏览次数</label>
											<div class="layui-input-inline" style="width: 105px;">
												<input type="text" class="layui-input" ng-model="click" placeholder="请输入浏览次数" />
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline">
											<label class="layui-form-label" style="height: 100px;line-height: 80px;background-color: #FBFBFB;border: 1px solid #e6e6e6;">内容摘要</label>
											<div class="layui-input-inline" style="width: 643px;">
												<textarea name="zhaiyao" class="layui-input" ng-model="zhaiyao" style="width:100%;height:100px;"></textarea>
											</div>
										</div>
						    		</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
										<?php if(empty($id)){?>
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
					    		<div class="wbox-content article-goods">
					    			<div class="layui-form-item">
						    			<div class="layui-inline" style="width: 100%;">
							    			<div class="layui-form-item">
							    				<div class="layui-inline" style="width: 100%;">
							    					<label class="layui-form-label" style="border: 0;background-color: #fff;"><b>*</b>内容</label>
													<div class="layui-input-inline" style="width: 89%;">
														<textarea name="content" id="content" style="width:700px;height:200px;visibility:hidden;" rows="8"><?php echo $model[0]["content"];?></textarea>
													</div>
							    				</div>
							    			</div>
						    			</div>
					    			</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
										<?php if(empty($id)){?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="保存" ng-click="save('add')" />
										<?php }else{?>
										<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal article-button" value="修改" ng-click="save('modify')" />
										<?php }?>
										<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" value="重置" ng-click="resave()" />
									</div>
					    		</div>
							</form>
				    	</div>
				    	<!--详情描述结束-->
				    	<!--SEO选项开始-->
				    	<div class="layui-tab-item">
				    		<form class="layui-form layui-form-pane">
					    		<div class="wbox-content article-goods">
					    			<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff;">SEO标题</label>
											<div class="layui-input-inline" style="width: 89%;">
												<input type="text" name="seo_title" ng-model="seo_title" class="layui-input" placeholder="请输入SEO标题" />
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff;">SEO关健字</label>
											<div class="layui-input-inline" style="width: 89%;">
												<textarea name="seo_keywords" ng-model="seo_keywords" style="width:100%;height:100px;"></textarea>
											</div>
										</div>
						    		</div>
						    		<div class="layui-form-item" style="margin-top: 10px;">
										<div class="layui-inline" style="width: 100%;">
											<label class="layui-form-label" style="border: 0;background-color: #fff;">SEO描述</label>
											<div class="layui-input-inline" style="width: 89%;">
												<textarea name="seo_description" ng-model="seo_description" style="width:100%;height:100px;"></textarea>
											</div>
										</div>
						    		</div>
					    			<div class="layui-form-item" style="margin-top: 15px;">
										<?php if(empty($id)){?>
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
	<script type="text/javascript" src="../../js/detailsArticle.js"></script>
</body>
</html>