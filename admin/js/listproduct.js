/*
* @description: 商品列表js
* @author: will
* @update: will (2017-02-22 11:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination', 'ngCookies']);
app.controller('listController', function ($scope, $http, $cookies) {
	var postData = {type: 'searchtype'};
    $http.post('../../Controller/product/detailsProductAction.php', postData).then(function (result) {  //正确请求成功时处理
    	$scope.typelist = result.data.list;
    }).catch(function () { //捕捉错误处理
        layer.msg('服务端请求错误！', {time: 3000});
    });
    if($cookies.get("typeid")!=''){
        $scope.typeid=$cookies.get("typeid");
    }
    if($cookies.get("parentid")!=''){
        $scope.parentid=$cookies.get("parentid");
    }
    if($cookies.get("status")!=''){
        $scope.status=$cookies.get("status");
    }
    if($cookies.get("ptype")!=''){
        $scope.ptype=$cookies.get("ptype");
    }
    if($cookies.get("productno")!=''){
        $scope.productno=$cookies.get("productno");
    }
    if($cookies.get("productname")!=''){
        $scope.productname=$cookies.get("productname");
    }
    if($cookies.get("currentPage")!=''){
        $scope.currentPage=$cookies.get("currentPage");
    }
    var reSearch = function () {
        var postData = {
            type: 'list',
            typeid: $scope.typeid,
            parentid: $scope.parentid,
            status: $scope.status,
            ptype: $scope.ptype,//产品类型 1、常规线  2、旅拍线 3、定制线
            productno: $scope.productno,
            productname: $scope.productname,
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/product/ProductAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.paginationConf.totalItems = result.data.rowCount;
            $scope.list = result.data.data;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.reSearch = reSearch;
    $scope.paginationConf = {//配置分页基本参数
        currentPage: $scope.currentPage ? $scope.currentPage : 1, //起始页
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
                $scope.checked.push(item.productid);
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
            var index = $scope.checked.indexOf(item.productid);
            if (item.checked && index === -1) {
                $scope.checked.push(item.productid);
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
    $scope.selectType = function (){
    	var parentid = $scope.parentid;
    	var postData = {type: 'selectType',parentid:parentid};
        $http.post('../../Controller/product/detailsProductAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.Nodelist = result.data.list;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.addModal = function (type) {
    	if(type=="1"){
    		layer.open({
                type: 2,
                title: '添加常规线路',
                area: ['100%', '100%'],
                anim: '2',
                resize: false,
                move: false,
                shadeClose: true,
                offset: ['0', '0'],
                content: 'detailsProduct.php',
            });
    	}else{
    		layer.open({
                type: 2,
                title: '添加定制线路',
                area: ['100%', '100%'],
                anim: '2',
                resize: false,
                move: false,
                shadeClose: true,
                offset: ['0', '0'],
                content: 'detailsCustomProduct.php',
            });
    	}
    }
    $scope.modifyModal=function (productid,type){
    	var productno = $scope.productno ? $scope.productno : '';
    	var ptype = $scope.ptype ? $scope.ptype : '';
    	var status = $scope.status ? $scope.status : '';
    	var parentid = $scope.parentid ? $scope.parentid : '';
    	var typeid = $scope.typeid ? $scope.typeid : '';
        var productname = $scope.productname ? $scope.productname : '';
        var currentPage = $scope.paginationConf.currentPage;
    	if (productno != '') {
            $cookies.put("productno", productno, {expires: new Date(new Date().getTime() + 36000)});
        }
    	if (ptype != '') {
            $cookies.put("ptype", ptype, {expires: new Date(new Date().getTime() + 36000)});
        }
    	if (status != '') {
            $cookies.put("status", status, {expires: new Date(new Date().getTime() + 36000)});
        }
    	if (parentid != '') {
            $cookies.put("parentid", parentid, {expires: new Date(new Date().getTime() + 36000)});
        }
    	if (typeid != '') {
            $cookies.put("typeid", typeid, {expires: new Date(new Date().getTime() + 36000)});
        }
    	if (productname != '') {
            $cookies.put("productname", productname, {expires: new Date(new Date().getTime() + 36000)});
        }
        $cookies.put("currentPage", currentPage, {expires: new Date(new Date().getTime() + 36000)});
    	if(type=="1"){
	    	layer.open({
	            type: 2,
	            title: '线路修改',
	            area: ['100%', '100%'],
	            anim: '2',
	            resize: false,
	            move: false,
	            shadeClose: true,
	            offset: ['0', '0'],
	            content: 'detailsProduct.php?productid=' + productid,
	        });
    	}else{
    		layer.open({
	            type: 2,
	            title: '线路修改',
	            area: ['100%', '100%'],
	            anim: '2',
	            resize: false,
	            move: false,
	            shadeClose: true,
	            offset: ['0', '0'],
	            content: 'detailsCustomProduct.php?productid=' + productid,
	        });
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
            layer.msg('请选择需要删除的产品！', {time: 3000});
        } else {
	        var postData = {type: 'del', ids: ids};
	        layer.alert('您确定要删除吗?', {icon: 5, title: "删除", resize: false,}, function(){
	            $http.post('../../Controller/product/ProductAction.php', postData).then(function (result) {  //正确请求成功时处理
	            	if (result.data=="true") { 
	                    layer.msg('删除成功！',{icon: 6,time:1000});
	                    return reSearch();
	                } else {
	                    layer.msg("删除失败！", {time: 2000});
	                }
	            }).catch(function () { //捕捉错误处理
	                layer.msg('服务端请求错误！', {time: 3000});
	            });
	        });
        }
    }
    $scope.downModal=function (productid,type){
    	if(type=="down"){
    		var postData = {type: 'downOrUp', productid: productid,status:1};//下架
    		layer.alert('亲，您确定下架该产品吗?', {icon: 5, title: "下架", resize: false,}, function(){
                $http.post('../../Controller/product/ProductAction.php', postData).then(function (result) {  //正确请求成功时处理
                	if (result.data=="true") {
                        layer.msg('下架成功！',{icon: 6,time:2000});
                        return reSearch();
                    } else {
                        layer.msg("下架失败！", {time: 2000});
                    }
                }).catch(function () { //捕捉错误处理
                    layer.msg('服务端请求错误！', {time: 2000});
                });
            });
    	}else{
    		var postData = {type: 'downOrUp', productid: productid,status:0};//上架
    		layer.alert('亲，您确定将该产品重新上架吗？?', {icon: 3, title: "上架", resize: false,}, function(){
                $http.post('../../Controller/product/ProductAction.php', postData).then(function (result) {  //正确请求成功时处理
                	if (result.data=="true") {
                        layer.msg('上架成功！',{icon: 6,time:2000});
                        return reSearch();
                    } else {
                        layer.msg("上架失败！", {time: 2000});
                    }
                }).catch(function () { //捕捉错误处理
                    layer.msg('服务端请求错误！', {time: 2000});
                });
            });
    	}
    }
    $scope.changeClass = function (id,index) {
    	$scope.id = id;
    	$scope.active = index;
    }
    $scope.resetSearch = function(){
    	$scope.typeid = undefined;
    	$scope.parentid = undefined;
        $scope.productno = '';
        $scope.currentPage = 0;
        $scope.productname = '';
        $scope.status = '';
        $scope.ptype = '';
    }
});
$(function(){
	/*删除选中的套餐提示*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定删除选中的套餐吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*删除单一套餐提示*/
	$(".goods-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该套餐吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*下架选中的套餐提示*/
	$(".xj-btn").on("click", function(){
		layer.alert('亲，您确定下架选中的套餐吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "下架",
		}, function(index){
			layer.msg('下架成功！',{icon: 6,time:1000});
		});
	});
	/*下架单一套餐提示*/
	$(".txj-btn").on("click", function(){
		layer.alert('亲，您确定下架该套餐吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "下架",
		}, function(index){
			layer.msg('下架成功！',{icon: 6,time:1000});
		});
	});
	/*上架单一套餐提示*/
	$(".tsj-btn").on("click", function(){
		layer.alert('亲，您确定将该套餐重新上架吗？', {
			icon: 3,
			resize: false, //禁止拉伸
			title: "上架",
		}, function(index){
			layer.msg('上架成功！',{icon: 6,time:1000});
		});
	});
	/*弹出回收站*/
	$('.btn-delete').on('click', function(){
		layer.open({
		type: 2,
			title: '回收站',
			area : ['100%' , '100%'],
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'recycleListGoodsCombo.php',
		});
	});
});