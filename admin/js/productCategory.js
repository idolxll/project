/*
* @description: 原料分类js
* @author: will
* @update: will (2017-02-26 10:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination']);
app.controller('listController', function ($scope, $http) {
	$scope.is_hot = false;
    var reSearch = function () {
        /*var postData = {
            type: 'list',
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.paginationConf.totalItems = result.data.rowCount;
            $scope.list = result.data.data;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });*/
    }
    $scope.reSearch = reSearch;
    $scope.paginationConf = {//配置分页基本参数
        currentPage: 1, //起始页
        itemsPerPage: 20, // 每页展示的数据条数
        perPageOptions: [20, 30, 50] //可选择显示条数的数组
    };
    $scope.$watch('paginationConf.currentPage + paginationConf.itemsPerPage', reSearch);
    $scope.selectType = function (){
    	var parentid = $scope.parentid;
    	var postData = {type: 'selectType',parentid:parentid};
        $http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.Nodelist = result.data.list;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.addModal = function (typeid) {
        $scope.typeid = typeid;
        $scope.typename = "";
        $scope.orderby = "";
        $scope.is_hot = false;
       if(typeid==undefined){
            layer.open({
                type: 2,
                title: '新增分类',
                area: ['100%', '100%'],
                anim: '2',
                resize: false,
                move: false,
                shadeClose: true,
                offset: ['0', '0'],
                content: 'reviceProduct.php',
            });
        }else{
            layer.open({
                type: 1,
                title: "添加子分类",//标题
                area: ['350px', '250px'],//宽高
                shadeClose: true, //点击遮罩关闭
                resize: false, //禁止拉伸
                content: $(".add"),//也可将html写在此处
            });
        }
    }
    $scope.modifyModal=function (typeid,typename,orderby,is_hot){
    	$scope.typeid = typeid;
    	$scope.typename = typename;
    	$scope.orderby = orderby;
    	if(is_hot==1){
    		$scope.is_hot = true;
    	}else{
    		$scope.is_hot = false;
    	}
    	layer.open({
			type: 1,
			title: "修改分类",//标题
			area: ['350px', '250px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".modify"),//也可将html写在此处
		});
    }
    $scope.changeClass = function (type) {
        if (type == 'is_hot') {
            $scope.is_hot = !$scope.is_hot;
        }
    }
    $scope.delModal=function (id){
    	var ids = '';
        if (angular.isUndefined(id)) {
            ids = $scope.checked;
        } else {
            ids = id;
        }
        if (ids == '') {
            layer.msg('请选择需要删除的产品分类！', {time: 3000});
        } else {
	        var postData = {type: 'del', ids: ids};
	        layer.alert('您确定要删除吗?', {icon: 5, title: "删除", resize: false,}, function(){
	            $http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
	            	if (result.data=="true") { 
	                    layer.msg('删除成功！',{icon: 6,time:1000});
	                    location.reload();
	                } else {
	                    layer.msg("删除失败！", {time: 2000});
	                }
	            }).catch(function () { //捕捉错误处理
	                layer.msg('服务端请求错误！', {time: 3000});
	            });
	        });
        }
    }
    $scope.save=function (type){
    	$scope.but = true;
        var zjm=makePy($(".addcity").val());//返回的是一个数组 
        zjm=zjm[0];//获取第一个助记码  
        var initial=zjm.toString().slice(0,1);
        console.log(initial);
    	var typename = $scope.typename;
		var orderby = $scope.orderby;
		var is_hot = $scope.is_hot;
		var typeid = $scope.typeid ? $scope.typeid : 0;
		if(!angular.isDefined($scope.typename) || $scope.typename==""){
			layer.msg("请输入产品分类名称", {time: 2000});
        	$scope.but = false;
        	return false;
		}
		if(!angular.isDefined($scope.orderby) || $scope.orderby==""){
			layer.msg("请输入排序", {time: 2000});
        	$scope.but = false;
        	return false;
		}
    	if(type=="add"){
    		var postData = {type: 'add', typeid: typeid,typename:typename,orderby:orderby,is_hot:is_hot,initial:initial};//添加
            $http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
            	if (result.data.code>0) {
            		var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                    layer.msg(result.data.message,{icon: 6,time:2000});
                    location.reload();
                } else {
                    layer.msg(result.data.message, {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 2000});
            });
    	}else{
    		if(!angular.isDefined($scope.typeid) || $scope.typeid==""){
    			layer.msg("请选择你要修改分类", {time: 2000});
            	$scope.but = false;
            	return false;
    		}
    		var postData = {type: 'modify', typeid: typeid,typename:typename,orderby:orderby,is_hot:is_hot,initial:initial};//修改
            $http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
            	if (result.data.code>0) {
            		var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                    layer.msg(result.data.message,{icon: 6,time:2000});
                    location.reload();
                } else {
                    layer.msg(result.data.message, {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 2000});
            });
    	}
    }
    $scope.resetDate = function(){
    	$scope.is_hot = false;
    	$scope.orderby = '';
        $scope.typename = '';
    }
});
