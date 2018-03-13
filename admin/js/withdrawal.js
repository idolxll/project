/*
* @description: 提现记录
* @author: will
* @update: will (2017-02-25 09:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination']);
app.controller('listController', function ($scope, $http) {
    var reSearch = function () {
        var postData = {
            type: 'list',
            status: $scope.status,
            typecard: $scope.type,
            mobile: $scope.mobile,
            logmin: $("#logmin").val(),
            logmax: $("#logmax").val(),
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/finance/recordDrawalAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.paginationConf.totalItems = result.data.rowCount;
            $scope.list = result.data.data;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.reSearch = reSearch;
    $scope.paginationConf = {//配置分页基本参数
        currentPage: 1, //起始页
        itemsPerPage: 20, // 每页展示的数据条数
        perPageOptions: [20, 30, 50] //可选择显示条数的数组
    };
    $scope.$watch('paginationConf.currentPage + paginationConf.itemsPerPage', reSearch);
    $scope.checked = [];
    $scope.selectAll = function () {
        if ($scope.select_all) {
            $scope.checked = [];
            angular.forEach($scope.list, function (item) {
                item.checked = true; 
                $scope.checked.push(item.watId);
            })
        } else {
            angular.forEach($scope.list, function (item) {
            	item.checked = false;
                $scope.checked = [];
            })
        }
    }
    $scope.selectOne = function () {
        angular.forEach($scope.list, function (item) {
            var index = $scope.checked.indexOf(item.watId);
            if (item.checked && index === -1) {
                $scope.checked.push(item.watId);
            } else if (!item.checked && index !== -1) {
                $scope.checked.splice(index, 1);
            }
        })
        if ($scope.list.length === $scope.checked.length) {
            $scope.select_all = true;
        } else {
            $scope.select_all = false;
        }
    }
    //一键审核
    $scope.reviewModal = function(){
    	var ids = $scope.checked;
        if (ids == '') {
            layer.msg('请选择需要审核的记录！', {time: 3000});
        }else{
        	var postData = {type: 'allshenhe', ids: ids};
        	layer.alert('您确定一键通过选中的提现吗？', {icon: 3, title: "提现", resize: false,}, function(){
                $http.post('../../Controller/finance/recordDrawalAction.php', postData).then(function (result) {  //正确请求成功时处理
                	if (result.data=="true") {
                        layer.msg('审核成功，请手动转账给分销商！',{icon: 6,time:2000});
                        return reSearch();
                    } else {
                        layer.msg("审核失败，金额已经退回给分销商！", {time: 2000});
                    }
                }).catch(function () { //捕捉错误处理
                    layer.msg('服务端请求错误！', {time: 2000});
                });
            });
        }
    }
    //一键支付
    $scope.payModal = function(){
    	var ids = $scope.checked;
        if (ids == '') {
            layer.msg('请选择需要审核的记录！', {time: 3000});
        }else{
	    	var postData = {type: 'allpay', ids: ids};
	    	layer.alert('您确定一键支付选中的提现吗？', {icon: 3, title: "提现", resize: false,}, function(){
	            $http.post('../../Controller/finance/recordDrawalAction.php', postData).then(function (result) {  //正确请求成功时处理
	            	if (result.data=="true") {
	                    layer.msg('支付成功，请手动转账给分销商！',{icon: 6,time:2000});
	                    return reSearch();
	                } else {
	                    layer.msg("支付失败，金额已经退回给分销商！", {time: 2000});
	                }
	            }).catch(function () { //捕捉错误处理
	                layer.msg('服务端请求错误！', {time: 2000});
	            });
	        });
        }
    }
    //审核  驳回
    $scope.WithdrawalsReviewed = function(watId,amount){
    	$("#review_open").addClass("in");
        $("#review_open").removeClass("hide");
        $("#review_open").css("z-index", "1060");
        $("#review_open").css("margin-top", "-135.5px");
        $(".modal-backdrop").css("display", "block");
        $('#id').val(watId);
        $('#amount').val(amount);
    }
    //单个审核
    $scope.rv_btn = function(){
        var status = "";
        $("input[name='review']:radio").each(function () {
            if (true == $(this).prop("checked")) {
                status += $(this).val() + ",";
            }
        });
        var lastIndex = status.lastIndexOf(',');
        if (lastIndex > -1) {
            status = status.substring(0, status.length - 1);
        }
        if (status == "") {
            layer.msg('请选择审核状态', {icon: 6, time: 1000});
            return false;
        }
        var id = $("#id").val();
        var amount = $("#amount").val();
        var reason = $("#yuanyin").val();
        //执行更新方法
        var postData = {
            balId: id,
            amount: amount,
            status: status,
            reason: reason,
            type: "shenhe"
        };
        $http.post('../../Controller/finance/recordDrawalAction.php', postData).then(function (json) {
            if (json.data=="true") {
            	if(status==5){
            		layer.msg('提现记录已经驳回，请注意查收账户余额!', {icon: 6, time: 2000});
            	}else{
            		layer.msg('已经提交审核!', {icon: 6, time: 2000});
            	}
                $('.modal-backdrop').css("display", "none");
                $("#review_open").addClass("hide");
                return reSearch();
            }
            else {
                layer.msg('提交审核失败!', {icon: 6, time: 2000});
            }
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 2000});
        });
	}
    //支付
    $scope.freeze_open = function(watId){
    	var postData = {
            balId: watId,
            status: 1,
            type: "pay"
        };
    	layer.alert('亲，您确定手工支付该提现记录吗？', {icon: 3, title: "提现", resize: false,}, function(){
            $http.post('../../Controller/finance/recordDrawalAction.php', postData).then(function (result) {  //正确请求成功时处理
            	if (result.data=="true") {
                    layer.msg('支付成功，请手动转账给分销商！',{icon: 6,time:2000});
                    return reSearch();
                } else {
                    layer.msg("支付失败，金额已经退回给分销商！", {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 2000});
            });
        });
    }
    //银行信息
    $scope.bind_bankinfo = function(bank_type,realname,cardname,cardnum){
    	if (bank_type == "2") {
            $("#bank_type").html("公司");
            $("#realname").html(realname);
        } else if (bank_type == "1") {
            $("#bank_type").html("个人");
            $("#realname").html(realname);
        }else {
        	$("#realname").html(realname);
            $("#bank_type").html("不存在");
        }
        $("#cardname").html(cardname);
        $("#cardnum").html(cardnum);
        $("#card_info").addClass("in");
        $("#card_info").removeClass("hide");
        $("#card_info").css("z-index", "1060");
        $("#card_info").css("margin-top", "-106.5px");
        $(".modal-backdrop").css("display", "block");
    }
    //关闭
    $scope.close = function(){
    	$("#card_info").addClass("hide");
        $("#card_info").removeClass("in");
        $("#card_info").css("z-index", "1060");
        $("#card_info").css("margin-top", "-106.5px");
        $(".modal-backdrop").css("display", "none");
    }
    $scope.resetSearch = function(){
    	$scope.typeid = undefined;
    	$scope.parentid = undefined;
        $scope.productno = '';
        $scope.currentPage = 0;
        $scope.productname = '';
    }
});
/*textarea 字数限制*/
function textarealength(obj,maxlength){
	var v = $(obj).val();
	var l = v.length;
	if( l > maxlength){
		v = v.substring(0,maxlength);
		$(obj).val(v);
	}
	$(obj).parent().find(".textarea-length").text(v.length);
}
