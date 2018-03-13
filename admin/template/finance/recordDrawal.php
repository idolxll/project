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
    <title>观世界后台-提现记录</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../css/will.css" />
    <script charset="utf-8" src="../../js/angular.min.js"></script>
    <script src="../../js/tmpagination/tm.pagination.js"></script>
</head>
<style>
.modal.fade.in {
    top: 50%;
}
.modal.fade {
    top: -100%;
}
.fade.in {
    opacity: 1;
    filter: alpha(opacity=100);
}
.hide {
    display: none;
}
.fade {
    opacity: 0;
    filter: alpha(opacity=0);
    -webkit-transition: opacity .2s linear;
    -moz-transition: opacity .2s linear;
    -o-transition: opacity .2s linear;
    transition: opacity .2s linear;
}
.modal {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 500px;
    margin-left: -250px;
    z-index: 1050;
    overflow: visible;
    background-color: #fff;
    background-clip: padding-box;
    box-shadow: 0 3px 7px rgba(0,0,0,0.3);
    -webkit-background-clip: padding-box;
    -khtml-background-clip: padding-box;
    -moz-background-clip: padding-box;
    -ms-background-clip: padding-box;
    -o-background-clip: padding-box;
    background-clip: padding-box;
    border-radius: 6px;
    border: 1px solid rgba(0,0,0,0.3);
}
.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1040;
    background-color: #000;
}
.modal-backdrop, .modal-backdrop.fade.in {
    opacity: .7;
    filter: alpha(opacity=70);
}
.modal-header {
    padding: 9px 15px;
    border-bottom: 1px solid #eee;
    position: relative;
}
.modal-header h3 {
    padding: 6px 0;
    font-size: 18px;
    color: #333;
}
.modal-header h3 {
    margin: 0;
}
.modal-header .close {
    display: block;
    top: 6px;
    right: 5px;
    width: 24px;
    text-align: center;
    color: #999;
    opacity: 1;
}
.modal-header .close {
    position: absolute;
    right: 10px;
    top: 10px;
}
.close {
    font-size: 20px;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .2;
    filter: alpha(opacity=20);
}
.modal-body {
    overflow-y: visible;
    padding: 15px;
    word-break: break-all;
}
p {
    margin-bottom: 10px;
}
.store_screen1 {
    width: 100%;
    overflow: hidden;
}
input[type="radio"], input[type="checkbox"] {
    line-height: normal;
    margin-top: -4px;
}
.store_screen2 {
    width: 100%;
    margin-top: 10px;
    overflow: hidden;
}
.textarea {
    height: 100px;
    resize: none;
    font-size: 14px;
    padding: 4px;
}
.input-text, .textarea {
    box-sizing: border-box;
    border: solid 1px #ddd;
    width: 100%;
    -webkit-transition: all .2s linear 0s;
    -moz-transition: all .2s linear 0s;
    -o-transition: all .2s linear 0s;
    transition: all .2s linear 0s;
}
.btn {
    display: inline-block;
    box-sizing: border-box;
    cursor: pointer;
    text-align: center;
    font-weight: 400;
    white-space: nowrap;
    vertical-align: middle;
    -moz-padding-start: npx;
    -moz-padding-end: npx;
    border: solid 1px #ddd;
    background-color: #fff;
    width: auto;
    -webkit-transition: background-color .1s linear;
    -moz-transition: background-color .1s linear;
    -o-transition: background-color .1s linear;
    transition: background-color .1s linear;
}
.btn-primary {
    color: #fff;
    background-color: #5a98de;
    border-color: #5a98de;
}
.btn, .btn.size-M {
    padding: 4px 12px;
}
.input-text, .btn, .input-text.size-M, .btn.size-M {
    font-size: 14px;
    height: 31px;
    line-height: 1.42857;
    padding: 4px;
}
.radius {
    border-radius: 4px;
}
</style>
<body ng-app="myApp">
	<div class="wrapper" ng-controller="listController">
		<div class="content">
			<div class="wboxform">
				<form class="layui-form">
					<div class="layui-form-item">
						<div class="layui-inline">
					    	<label class="layui-form-label">状态：</label>
					    	<div class="layui-input-inline">
					    		<select class="layui-input" ng-model="status">
							        <option value="" selected="selected">请选择...</option>
							        <option value="1">提现成功</option>
									<option value="2">审核中</option>
									<option value="3">审核通过</option>
									<option value="4">支付</option>
									<option value="5">提现失败</option>
									<option value="8">退款</option>
							    </select>
					    	</div>
						</div>
						<div class="layui-inline">
					    	<label class="layui-form-label"> 账户类型：</label>
					    	<div class="layui-input-inline">
					    		<select class="layui-input" ng-model="type">
							        <option value="" selected="selected">请选择...</option>
							        <option value="1">个人</option>
									<option value="2">公司</option>
							    </select>
					    	</div>
						</div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">手机号码</label>
					    	<div class="layui-input-inline" style="width: 105px;">
					        	<input type="text" ng-model="mobile" class="layui-input" placeholder="请输入手机号码">
					    	</div>
					    </div>
					    <br />
					    <div class="layui-inline">
					    	<label class="layui-form-label">申请时间</label>
					    	<div class="layui-input-inline">
					        	<input style="width:160px;" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" id="logmin" class="layui-input Wdate">
					    	</div>
					    </div>
					    <div class="layui-inline">
					    	<label class="layui-form-label">到</label>
					    	<div class="layui-input-inline">
					        	<input style="width:160px;" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" id="logmax" class="layui-input Wdate">
					    	</div>
					    </div>
					    <input type="button" class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()" value="查询" />
						<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resetSearch()" value="重置" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-title">
					<h5>提现记录</h5>
					<div class="ibox-tools">
						<a class="btn-blue details-btn" ng-click="reviewModal()">一键审核</a>
						<a class="btn-orange details-btn" ng-click="payModal()">一键支付</a>
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
									<th width="2%"><input type="checkbox" ng-model="select_all" ng-click="selectAll()"></th>
									<th width="8%">手机号码</th>
									<th width="8%">姓名</th>
									<th width="8%">提现金额</th>
									<th width="18%">申请时间</th>
									<th width="18%">付款时间</th>
									<th width="8%">银行信息</th>
									<th>提现状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-c" ng-repeat="item in list" ng-cloak>
									<td><input type="checkbox" ng-model="item.checked" ng-change="selectOne()"/></td>
									<td>{{item.mobile}}</td>
									<td>{{item.account}}</td>
									<td>{{item.amount}}</td>
									<td>{{item.createDate}}</td>
									<td>{{item.modifyDate}}</td>
									<td><a ng-click="bind_bankinfo(item.cardtype,item.account,item.bankName,item.num)">查看</a>
									</td>
									<td ng-if="item.status==1" class="c-green">提现成功</td>
									<td ng-if="item.status==2" class="c-orange">待审核</td>
									<td ng-if="item.status==3" class="c-orange">审核通过</td>
									<td ng-if="item.status==4" class="c-orange">支付</td>
									<td ng-if="item.status==5" class="c-red">提现失败</td>
									<td ng-if="item.status==8" class="c-red">退款</td>
									<td ng-if="item.status==2">
										<a class="btn-green revise-btn" ng-click="WithdrawalsReviewed(item.watId,item.amount)">审核</a>
									</td>
									<td ng-if="item.status==3">
										<a class="btn-green revise-btn" ng-click="freeze_open(item.watId)">手工支付</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<tm-pagination conf="paginationConf"></tm-pagination>
				</div>
			</div>
		</div>
		<!--审核、重审-->
		<div id="review_open" class="modal fade hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1060; margin-top: -135.5px;">
		    <div class="modal-header">
		        <h3 id="myModalLabel">审核/重审</h3><a class="close" data-dismiss="modal" aria-hidden="true" ng-click="close()" href="javascript:void();">×</a>
		    </div>
		    <div class="modal-body" style="padding: 20px 15px 25px">
		        <form action="../../Controller/finace/FINUserBalanceAction.php" method="post" class="form form-horizontal" id="form-review-add">
		            <input type="hidden" id="id" name="id" value="">
		            <input type="hidden" id="amount" name="amount" value="">
		            <div class="store_screen1" id="checkb">
		            <span style="padding-right: 20px;"><input name="review" type="radio" id="review-1" value="3" checked="true"> <label for="review-1">通过</label></span>
		            <span><input type="radio" id="review-2" name="review" value="5"><label for="review-2">驳回</label></span></div>
		            <div class="store_screen2">
		                填写原因：
		                <textarea id="yuanyin" name="yuanyin" cols="" rows="" class="textarea" placeholder="请输入驳回的原因...最少输入2个字符" onkeyup="textarealength(this,100)" style="margin-top: 5px; height: 70px;"></textarea>
		                <p class="textarea-numberbar" style="bottom: 42px;"><em class="textarea-length">0</em>/100</p>
		            </div>
		            <div class="store_screen2">
		                <input type="hidden" id="action" value="act">
		                <input type="hidden" id="shenheId">
		                <input class="btn btn-primary radius" ng-click="rv_btn()" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		            </div>
		        </form>
		    </div>
		</div>
		<!--查看提现信息-->
		<div id="card_info" class="modal fade hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1060; margin-top: -106.5px;">
		    <div class="modal-header">
		        <h3 id="myModalLabel">银行卡信息</h3><a class="close" data-dismiss="modal" aria-hidden="true" ng-click="close()" href="javascript:void();">×</a>
		    </div>
		    <div class="modal-body">
		        <p>账户类型：<font id="bank_type"></font></p>
		        <p>真实姓名：<font id="realname"></font></p>
		        <p>开户银行：<font id="cardname"></font></p>
		        <p>银行卡号：<font id="cardnum"></font></p>
		    </div>
		</div>
		<div class="modal-backdrop fade in" style="z-index: 1050; display: none;" ng-click="close()"></div>
	</div>
	<script type="text/javascript" src="../../js/jquery.min.js" ></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js" ></script>
	<script type="text/javascript" src="../../js/layui.js"></script>
	<script type="text/javascript" src="../../js/withdrawal.js"></script>
	<script type="text/javascript" src="../../js/My97DatePicker/WdatePicker.js"></script>
</body>
</html>