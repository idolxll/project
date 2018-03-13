/*
* @description: 商品列表js
* @author: will
* @update: will (2017-02-22 11:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination']);
app.controller('listController', function ($scope, $http) {
    var reSearch = function () {
        var postData = {
            type: 'list',
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/material/materialCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
            $scope.paginationConf.totalItems = result.data.total;
            $scope.list = result.data.list;
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
    $scope.addModal = function () {
        $scope.type='add';
        $scope.levelName='';
        layer.open({type: 1, title: "添加分类", area: ['310px', '150px'], shadeClose: true, resize: false, content: $("#deal"),});
    }
    $scope.modifyModal=function (id,name){
        $scope.type='modify';
        $scope.levelName='';
        $scope.mid=id;
        $scope.levelName=name;
        layer.open({type: 1, title: "修改设置", area: ['310px', '150px'], shadeClose: true, resize: false, content: $("#deal"),});
    }
    $scope.delModal=function (id){
        var postData = {type: 'del', id: id};
        layer.alert('您确定要删除吗?', {icon: 5, title: "删除", resize: false,}, function(){
            $http.post('../../Controller/material/materialCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
                if (result.data.success) {
                    layer.msg('删除成功！',{icon: 6,time:1000});
                    return reSearch();
                } else {
                    layer.msg(result.data.message, {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 3000});
            });
        });
    }
    $scope.dealModal = function () {
        if($scope.type=='add'){
            var postData = {type: $scope.type, typeName: $scope.levelName};
        }else{
            var postData = {type: $scope.type, id: $scope.mid,typeName:$scope.levelName};
        }
        console.log(postData);
        $http.post('../../Controller/material/materialCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
            if (result.data.success) {
                layer.closeAll('page'); //关闭弹层
                layer.msg(result.data.message, {icon: 6, time: 1000});
                return reSearch();
            } else {
                layer.msg(result.data.message, {time: 2000});
            }
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
});
$(function(){
	/*删除选中的商品提示*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定删除选中的商品吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*删除单一商品提示*/
	$(".goods-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该商品吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*下架选中的商品提示*/
	$(".xj-btn").on("click", function(){
		layer.alert('亲，您确定下架选中的商品吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "下架",
		}, function(index){
			layer.msg('下架成功！',{icon: 6,time:1000});
		});
	});
	/*下架单一商品提示*/
	$(".txj-btn").on("click", function(){
		layer.alert('亲，您确定下架该商品吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "下架",
		}, function(index){
			layer.msg('下架成功！',{icon: 6,time:1000});
		});
	});
	/*上架单一商品提示*/
	$(".tsj-btn").on("click", function(){
		layer.alert('亲，您确定将该商品重新上架吗？', {
			icon: 3,
			resize: false, //禁止拉伸
			title: "上架",
		}, function(index){
			layer.msg('上架成功！',{icon: 6,time:1000});
		});
	});
	
	/*弹出编辑商品*/
	$('.details-btn').on('click', function(){
		layer.open({
			type: 2,
			title: '商品编辑',
			area : ['100%' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsGoods.html',
		});
	});
	
	/*弹出商品价格调控*/
	$('.price-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '商品价格调控',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'priceControl.html',
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
			content: 'recycleListGoods.html',
		});
	});
	
	/*弹出标签打印*/
	$('.print-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '商品标签打印',
			area : ['400px' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'printLabel.html',
		});
	});
});