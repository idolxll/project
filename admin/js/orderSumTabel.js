/*
* @description: 订单汇总js
* @author: will
* @update: will (2017-03-30 17:30)
* @version: v1.0
*/
var app = angular.module('myApp', ['tm.pagination']);
app.controller('listController', function ($scope, $http) {
    var reSearch = function () {
        var postData = {
            type: 'list',
            realName: $scope.realName ? $scope.realName : "",
            mobile: $scope.mobile ? $scope.mobile : "",
            startDate: $scope.startDate ? $scope.startDate : "",
            endDate: $scope.endDate ? $scope.endDate : "",
            orderno: $scope.no ? $scope.no : "",
            orderState: $scope.orderState ? $scope.orderState : "",
            currentPage: $scope.paginationConf.currentPage,
            itemsPerPage: $scope.paginationConf.itemsPerPage,
        };
        $http.post('../../Controller/order/listOdrorderAction.php', postData).then(function (result) {  //正确请求成功时处理
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
    $scope.lookModel=function (orderid){
    	layer.open({
			type: 2,
			title: '订单详情',
			area : ['460px' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: 't',
			offset: 'l',
			content: 'detailsOrder.php?orderid='+orderid,
		});
    }
    $scope.resetSearch = function(){
        $scope.startDate = '';
        $scope.currentPage = 0;
        $scope.endDate = '';
        $scope.realName = '';
        $scope.mobile = '';
        $scope.no = '';
        $scope.orderState = '';
    }
});