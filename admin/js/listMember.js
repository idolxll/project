/*
* @description: 会员列表js
* @author: will
* @update: will (2017-03-16 17:30)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination']);
app.controller('listController', function ($scope, $http) {
    var reSearch = function () {
        var postData = {
            type: 'list',
            realName: $scope.realName,
            mobile: $scope.mobile,
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/member/listMemberAction.php', postData).then(function (result) {  //正确请求成功时处理
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
    $scope.searchRecord = function (uid) {
    	layer.open({
			type: 2,
			title: '资金记录',
			area : ['540px' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: 't',
			offset: 'r',
			content: 'billtMember.php?uid='+uid,
		});
    }
    $scope.look = function (owneruid) {
    	layer.open({
			type: 2,
			title: '我的下级',
			area : ['540px' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: 't',
			offset: 'r',
			content: 'subMember.php?owneruid='+owneruid,
		});
    }
    $scope.Logout=function (id){
        var postData = {type: 'logout', id: id};
        layer.alert('会员注销将把账户冻结，会员账号不可使用，请谨慎操作！?', {icon: 5, title: "注销", resize: false,}, function(){
            $http.post('../../Controller/member/listMemberAction.php', postData).then(function (result) {  //正确请求成功时处理
            	if (result.data=="true") { 
                    layer.msg('注销成功！',{icon: 6,time:1000});
                    return reSearch();
                } else {
                    layer.msg("注销失败！", {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 3000});
            });
        });
    }
    $scope.upgrade=function (id,realName,vip){
        var postData = {type: 'upgrade', id: id, vip: vip};
        layer.alert('确认要把会员【'+realName+'】升级成为'+ vip +'级分销商吗！?', {icon: 6, title: "升级", resize: false,}, function(){
            $http.post('../../Controller/member/listMemberAction.php', postData).then(function (result) {  //正确请求成功时处理
            	if (result.data.code=="1") { 
                    layer.msg('升级成功！',{icon: 6,time:1000});
                    return reSearch();
                } else {
                    layer.msg("升级失败！", {time: 2000});
                }
            }).catch(function () { //捕捉错误处理
                layer.msg('服务端请求错误！', {time: 3000});
            });
        });
    }
    $scope.resetSearch = function(){
        $scope.realName = '';
        $scope.currentPage = 0;
        $scope.mobile = '';
    }
});