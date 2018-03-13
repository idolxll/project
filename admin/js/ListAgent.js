/*
* @description: 服务商列表js
* @author: billy
* @update: billy (2018-02-22 11:10)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination', 'ngCookies']);
app.controller('listController', function ($scope, $http, $cookies) {
	var postData = {type: 'searchtype'};
    $http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (res) {  //正确请求成功时处理
    	$scope.prolist = res.data.list;
    })
    var postRecord = {type: 'centerData'};
    $http.post('../../Controller/channel/ListAgentAction.php', postRecord).then(function (res) {  //正确请求成功时处理
    	$scope.cenlist = res.data.list.data;
    })
    var reSearch = function () {
        var postData = {
            type: 'list',
            cenId: $scope.cenId,
            realName: $scope.ageName,
            mobile: $scope.mobile,
            proId: $scope.proId,
            cityId: $scope.cityId,
            startDate: $scope.startDate,
            endDate: $scope.endDate,
            status: $scope.status,
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (result) {  //正确请求成功时处理
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
    	var proId = $scope.pId;
    	var postData = {type: 'selectType',proId:proId};
        $http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.Nodelist = result.data.list;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.selectType1 = function (){
    	var proId = $scope.proId;
    	var postData = {type: 'selectType',proId:proId};
        $http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (result) {  //正确请求成功时处理
        	$scope.citylist = result.data.list;
        }).catch(function () { //捕捉错误处理
            layer.msg('服务端请求错误！', {time: 3000});
        });
    }
    $scope.addModal=function (){
    	layer.open({
			type: 1,
			title: "服务商",//标题
			area: ['532px', '300px'],//宽高
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
    $scope.modifyModal=function (realName,mobile,startDate,endDate,ageId,userId){
    	$scope.ageId = ageId;
    	$scope.userId = userId;
    	$scope.startTime = startDate;
    	$scope.endTime = endDate;
    	$scope.agentName = realName;
    	$scope.phone = mobile;
    	layer.open({
			type: 1,
			title: "服务商",//标题
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
    	$http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (result) {  //正确请求成功时处理
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
    	var realName = $scope.agentName;
    	var mobile = $scope.phone;
    	var startDate = $scope.startTime;
    	var endDate = $scope.endTime;
    	if(type=="add"){//添加
    		var cId = $scope.cId;
    		var password = $scope.password;
        	var proId = $scope.pId;
        	var cityId = $scope.cityNo;
    		var postData = {
    	            type: 'add',
    	            realName: realName,
    	            mobile: mobile,
    	            startDate: startDate,
    	            endDate:endDate,
    	            password:password,
    	            cId:  cId,
    	            proId:  proId,
    	            cityId:  cityId,
    	            state:  1,
    	            valid:  1
    	        };
    	}else if(type=="modify"){//修改
    		var ageId = $scope.ageId;
    		var userId = $scope.userId;
    		var postData = {
    	            type: 'modify',
    	            realName: realName,
    	            mobile: mobile,
    	            startDate: startDate,
    	            endDate:endDate,
    	            ageId:  ageId,
    	            userId:  userId
    	        };
    	}
    	$http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (result) {  //正确请求成功时处理
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
            $http.post('../../Controller/channel/ListAgentAction.php', postData).then(function (result) {  //正确请求成功时处理
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
        $scope.cenId = '';
        $scope.ageName = '';
        $scope.proId = '';
        $scope.cityId = '';
        $scope.endDate = '';
        $scope.startDate = '';
    }
});
