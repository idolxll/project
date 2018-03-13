/*
* @description: 文章列表js
* @author: will
* @update: will (2017-02-22 11:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination']);
app.controller('listController', function ($scope, $http) {
	var postData = {type: 'searchtype'};
    $http.post('../../Controller/article/detailsArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
    	$scope.typelist = result.data.list;
    }).catch(function () { //捕捉错误处理
        layer.msg('服务端请求错误！', {time: 3000});
    });
    var reSearch = function () {
        var postData = {
            type: 'list',
            typeid: $scope.typeid,
            parentid: $scope.parentid,
            title: $scope.title,
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/article/ArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
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
                $scope.checked.push(item.id);
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
                $scope.checked.push(item.id);
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
        $http.post('../../Controller/article/detailsArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.Nodelist = result.data.list;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.addModal = function () {
        layer.open({
            type: 2,
            title: '添加文章',
            area: ['100%', '100%'],
            anim: '2',
            resize: false,
            move: false,
            shadeClose: true,
            offset: ['0', '0'],
            content: 'detailsArticle.php',
        });
    }
    $scope.modifyModal=function (id){
    	layer.open({
            type: 2,
            title: '文章修改',
            area: ['100%', '100%'],
            anim: '2',
            resize: false,
            move: false,
            shadeClose: true,
            offset: ['0', '0'],
            content: 'detailsArticle.php?id=' + id,
        });
    }
    $scope.delModal=function (id){
    	var ids = '';
        if (angular.isUndefined(id)) {
            ids = $scope.checked;
        } else {
            ids = id;
        }
        if (ids == '') {
            layer.msg('请选择需要删除的文章！', {time: 3000});
        } else {
	        var postData = {type: 'del', ids: ids};
	        layer.alert('您确定要删除吗?', {icon: 5, title: "删除", resize: false,}, function(){
	            $http.post('../../Controller/article/ArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
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
    $scope.resetSearch = function(){
    	$scope.typeid = undefined;
    	$scope.parentid = undefined;
        $scope.currentPage = 0;
        $scope.title = '';
    }
});
