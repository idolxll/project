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
            type: 'memlist',
            owneruid: $scope.owneruid ? $scope.owneruid : 0,
            realName: $scope.realName ? $scope.realName : "",
            mobile: $scope.mobile ? $scope.mobile : "",
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
    $scope.resetSearch = function(){
        $scope.realName = '';
        $scope.currentPage = 0;
        $scope.mobile = '';
    }
});