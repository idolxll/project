/*
* @description: 运营中心列表js
* @author: billy
* @update: billy (2018-02-22 11:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination', 'ngCookies']);
app.controller('listController', function ($scope, $http, $cookies) {
	var postData = {type: 'searchtype'};
    $http.post('../../Controller/channel/ListOperatorsAction.php', postData).then(function (res) {  //正确请求成功时处理
    	$scope.prolist = res.data.list;
    })
    var reSearch = function () {
        var postData = {
            type: 'list',
            mobile: $scope.mobile,
            status: $scope.status,
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/channel/ListOperatorsAction.php', postData).then(function (result) {  //正确请求成功时处理
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
    $scope.selectType = function (){
    	var proId = $scope.proId;
    	var postData = {type: 'selectType',proId:proId};
        $http.post('../../Controller/channel/ListOperatorsAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.Nodelist = result.data.list;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.addModal=function (){
    	layer.open({
			type: 1,
			title: "运营中心",//标题
			area: ['600px', '300px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $("#add"),//也可将html写在此处
		});
    }
    $scope.resetPass=function (userId){
    	$scope.userId = userId;
    	layer.open({
			type: 1,
			title: "重置密码",//标题
			area: ['500px', '120px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $("#resetPass"),//也可将html写在此处
		});
    }
    $scope.modifyModal=function (realName,mobile,startDate,endDate,cenId,userId){
    	$scope.cenId = cenId;
    	$scope.userId = userId;
    	$scope.startDate = startDate;
    	$scope.endDate = endDate;
    	$scope.cenName = realName;
    	$scope.phone = mobile;
    	layer.open({
			type: 1,
			title: "运营中心",//标题
			area: ['481px', '200px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $("#modify"),//也可将html写在此处
		});
    }
    $scope.savePass=function (){
    	$scope.but = true;
    	var postData = {
            type: 'resetPass',
            userId: $scope.userId,
            password: $scope.newpassword
        };
    	if(!angular.isDefined($scope.newpassword)){
			$scope.but = false;
            layer.msg('请输入密码', {time: 1500});
            return;
		}
    	$http.post('../../Controller/channel/ListOperatorsAction.php', postData).then(function (result) {  //正确请求成功时处理
    		if (result.data=="true") { 
            	layer.closeAll('page'); //关闭弹层
                layer.msg("已经重置密码", {icon: 6, time: 1000});
                return reSearch();
            } else {
            	$scope.but = false;
                layer.msg("出现异常，更新失败", {time: 3000});
            }
        }).catch(function () { //捕捉错误处理
        	$scope.but = false;
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.saveModel=function (type){
    	$scope.but = true;
    	var realName = $scope.cenName;
    	var mobile = $scope.phone;
    	var startDate = $scope.startDate;
    	var endDate = $scope.endDate;
    	if(type=="add"){//添加
    		var allCity = $scope.allCity;
        	var proId = $scope.proId;
        	var cityId = $scope.cityId;
        	var password = $scope.password;
    		var postData = {
    	            type: 'add',
    	            realName: realName,
    	            mobile: mobile,
    	            startDate: startDate,
    	            endDate:endDate,
    	            password:password,
    	            allCity:  allCity,
    	            proId:  proId,
    	            cityId:  cityId,
    	            state:  1,
    	            valid:  1
    	        };
    	}else if(type=="modify"){//修改
    		var cenId = $scope.cenId;
    		var userId = $scope.userId;
    		var postData = {
    	            type: 'modify',
    	            realName: realName,
    	            mobile: mobile,
    	            startDate: startDate,
    	            endDate:endDate,
    	            cenId:  cenId,
    	            userId:  userId
    	        };
    	}
    	$http.post('../../Controller/channel/ListOperatorsAction.php', postData).then(function (result) {  //正确请求成功时处理
            if (result.data.code>0) {
            	layer.closeAll('page'); //关闭弹层
                layer.msg(result.data.message, {icon: 6, time: 1000});
                return reSearch();
            } else {
            	$scope.but = false;
                layer.msg(result.data.message, {time: 3000});
            }
        }).catch(function () { //捕捉错误处理
        	$scope.but = false;
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.del=function (userId,cenId,type){
        var postData = {type: type,  userId: userId, cenId: cenId};
        layer.alert('确认要'+type+'吗?', {icon: 5, title: type, resize: false,}, function(){
            $http.post('../../Controller/channel/ListOperatorsAction.php', postData).then(function (result) {  //正确请求成功时处理
            	if (result.data=="true") { 
                    layer.msg(''+type+'成功！',{icon: 6,time:1000});
                    return reSearch();
                } else {
                    layer.msg(""+type+"失败！", {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 3000});
            });
        });
    }
    $scope.resetSearch = function(){
        $scope.status = '';
        $scope.mobile = '';
    }
});
