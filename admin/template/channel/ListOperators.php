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
    <title>观世界后台-运营中心列表</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="../../css/common.css" />
    <link rel="stylesheet" href="../../css/layui.css" />
    <link rel="stylesheet" href="../../css/will.css" />
    <link rel="stylesheet" href="../../js/My97DatePicker/skin/default/datepicker.css" />
    <script charset="utf-8" src="../../js/angular.min.js"></script>
    <script src="../../js/angular-cookies.min.js"></script>
    <script src="../../js/tmpagination/tm.pagination.js"></script>
</head>
<body ng-app="myApp">
	<div class="wrapper" ng-controller="listController">
		<div class="content">
			<div class="wboxform">
				<form class="layui-form">
					<div class="layui-form-item">
						<div class="layui-inline">
					    	<label class="layui-form-label">手机号码</label>
					    	<div class="layui-input-inline" style="width: 120px;">
					        	<input type="text" ng-model="mobile" class="layui-input" placeholder="手机号码">
					    	</div>
					    </div>
						<div class="layui-inline">
					    	<label class="layui-form-label">状态</label>
					    	<div class="layui-input-inline">
					    		<select class="layui-input" ng-model="status">
							        <option value="" selected="selected">请选择...</option>
							        <option ng-value="0">已到期</option>
							        <option ng-value="1">已冻结</option>
							        <option ng-value="2">正常</option>
							    </select>
					    	</div>
						</div>
					    <input type="button" class="layui-btn layui-btn-small layui-btn-normal" ng-click="reSearch()" value="查询" />
						<input type="reset" class="layui-btn layui-btn-small layui-btn-primary" ng-click="resetSearch()" value="重置" />
					</div>
				</form>
			</div>
			<div class="wbox">
				<div class="wbox-title">
					<h5>运营中心列表</h5>
					<div class="ibox-tools">
						<a class="btn-blue mbxx-btn" ng-click="addModal()">新增运营中心</a>
						<a class="btn-shuaxin" href="javascript:location.replace(location.href);" title="刷新">
							<i class="iconfont will-shuaxin"></i>
						</a>
					</div>
				</div>
				<div class="wbox-content">
					<div class="con-table">
						<table class="layui-table" style="min-width: 1300px;">
							<thead>
								<tr class="text-c">
									<th width="10%">运营中心</th>
									<th width="8%">手机</th>
									<th width="8%">余额</th>
									<th width="13%">起始时间</th>
									<th width="13%">终止时间</th>
									<th width="10%">区域</th>
									<th width="6%">全国权限</th>
									<th width="4%">状态</th>
									<th>操作</th>
								</tr>
								</thead>
								<tbody>
									<tr class="text-c" ng-repeat="item in list" ng-cloak>
										<td>{{item.realName}}</td>
										<td>{{item.mobile}}</td>
										<td>￥{{item.wallet ? item.wallet : 0}}</td>
										<td>{{item.startDate}}</td>
										<td>{{item.endDate}}</td>
										<td>{{item.provice}}{{item.provice ? '/' : ''}}{{item.city}}</td>
										<td>{{item.allCity ? '否' : '是'}}</td>
										<td class="c-red"  ng-if="item.status==0">已过期</td>
										<td class="c-red"  ng-if="item.status==1">已冻结</td>
										<td class="c-green"  ng-if="item.status==2">正常</td>
										<td>
											<a ng-if="item.status==1" class="btn-blue del-btn" ng-click="del(item.userId,item.cenId,'解冻')">解冻</a>
											<a ng-if="item.status==2" class="btn-red del-btn" ng-click="del(item.userId,item.cenId,'冻结')">冻结</a>
											<a class="btn-green mbxx-btn" ng-click="modifyModal(item.realName,item.mobile,item.startDate,item.endDate,item.cenId,item.userId)">修改</a>
											<a class="btn-orange del-btn" ng-click="resetPass(item.userId)">重置密码</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<tm-pagination conf="paginationConf"></tm-pagination>
				</div> 
			</div>
		</div>
		<!--编辑模板消息-->
		<div class="popup popup-mbxx" id="add">
			<form class="layui-form ng-pristine ng-valid">
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">&nbsp;运营中心：</label>
	                    <div class="layui-input-inline" style="width: 120px;">
	                        <input type="text" class="layui-input" placeholder="运营中心" ng-model="cenName">
	                    </div>
	                </div>
	                <div class="layui-inline">
	                    <label class="layui-form-label">手机号码：</label>
	                    <div class="layui-input-inline" style="width: 120px;">
	                        <input type="text" class="layui-input" placeholder="手机号码" ng-model="phone">
	                    </div>
	                </div>
	                <div class="layui-inline">
	                    <label class="layui-form-label">密码：</label>
	                    <div class="layui-input-inline" style="width: 96px;">
	                        <input type="password" class="layui-input" placeholder="密码" ng-model="password">
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">&nbsp;起止时间：</label>
	                    <div class="layui-input-inline" style="width: 170px;">
	                        <input type="text" class="layui-input Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F{$dp.$D(\'datemin3\')||\'%y-%M-%d\'}'})" onchange="" ng-model="startDate">
	                    </div>
	                </div>
	                <div class="layui-inline">
	                    <label class="layui-form-label">-</label>
	                    <div class="layui-input-inline" style="width: 170px;">
	                        <input type="text" class="layui-input Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F{$dp.$D(\'datemin3\')||\'%y-%M-%d\'}'})" onchange="" ng-model="endDate">
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">全　　  国：</label>
	                    <div class="layui-input-inline" style="width: 200px;    margin-top: 8px;">
	                        <input type="checkbox" ng-model="allCity" name="allcheck" style="display:inline-block;">&nbsp;
	                        <span style="color:#f00;">开通全国服务商权限</span>
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">区　　  域：</label>
	                    <div class="layui-input-inline" style="width: 170px;">
	                        <select class="layui-input" ng-model="proId" ng-change="selectType()">
	                        		<option value="" selected="selected">请选择...</option>
	                        		<option ng-repeat="item in prolist" ng-cloak ng-value="item.id">{{item.name}}</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="layui-inline">
	                    <label class="layui-form-label">-</label>
	                    <div class="layui-input-inline" style="width: 170px;">
	                        <select class="layui-input " ng-model="cityId">
	                        	<option value="" selected="selected">请选择...</option>
	                        	<option ng-repeat="item in Nodelist" ng-cloak ng-value="item.id">{{item.name}}</option>
	                        </select>
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;</label>
					<input type="button" ng-disabled="but"  class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="saveModel('add')"  value="确认保存">
				</div>
	        </form>
		</div>
		<div class="popup popup-mbxx" id="modify">
			<form class="layui-form ng-pristine ng-valid">
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">&nbsp;运营中心：</label>
	                    <div class="layui-input-inline" style="width: 138px;">
	                        <input type="text" class="layui-input" placeholder="运营中心" ng-model="cenName">
	                    </div>
	                </div>
	                <div class="layui-inline">
	                    <label class="layui-form-label">手机号码：</label>
	                    <div class="layui-input-inline" style="width: 138px;">
	                        <input type="text" class="layui-input" placeholder="手机号码" ng-model="phone">
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">&nbsp;起止时间：</label>
	                    <div class="layui-input-inline" style="width: 170px;">
	                        <input type="text" class="layui-input Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F{$dp.$D(\'datemin3\')||\'%y-%M-%d\'}'})" onchange="" ng-model="startDate">
	                    </div>
	                </div>
	                <div class="layui-inline">
	                    <label class="layui-form-label">-</label>
	                    <div class="layui-input-inline" style="width: 170px;">
	                        <input type="text" class="layui-input Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F{$dp.$D(\'datemin3\')||\'%y-%M-%d\'}'})" onchange="" ng-model="endDate">
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;</label>
					<input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="saveModel('modify')" value="确认保存">
				</div>
	        </form>
		</div>
		<div class="popup popup-mbxx" id="resetPass">
			<form class="layui-form ng-pristine ng-valid">
	            <div class="layui-form-item" style="margin-top: 10px;">
	                <div class="layui-inline">
	                    <label class="layui-form-label">&nbsp;密码：</label>
	                    <div class="layui-input-inline" style="width: 250px;">
	                        <input type="password" class="layui-input" placeholder="请输入新密码" ng-model="newpassword" >
	                    </div>
	                    <div class="layui-input-inline" style="width: 50px;">
	                        <input type="button" ng-disabled="but" class="layui-btn layui-btn-small layui-btn-normal Level-submit" ng-click="savePass()" value="确认保存">
	                    </div>
	                </div>
	            </div>
	            <div class="layui-form-item" style="margin-top: 10px;">
					<label class="layui-form-label">&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;&#12288;</label>
					
				</div>
	        </form>
		</div>
	</div>
	<input type="hidden" ng-model="cenId"/>
	<input type="hidden" ng-model="userId"/>
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/layer/layer.min.js"></script>
	<script type="text/javascript" src="../../js/layui.js"></script>
	<script type="text/javascript" src="../../js/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="../../js/ListOperators.js"></script>
</body>
</html>