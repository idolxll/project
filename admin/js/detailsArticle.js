/*
* @description: 编辑套餐js
* @author: will
* @update: will (2017-03-16 15:40)
* @version: v1.0
*/
var app = angular.module('myApp', []);
	app.controller('listController', function ($scope, $http) {
		$scope.is_slide = false;
		$scope.is_top = false;
		$scope.is_red = false;
		$scope.is_hot = false;
		var postData = {type: 'searchtype'};
	    $http.post('../../Controller/article/detailsArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
	    	$scope.list = result.data.list;
	    }).catch(function () { //捕捉错误处理
	        layer.msg('服务端请求错误！', {time: 3000});
	    });
	    $scope.title = title;
	    //$("#productno").val(productno);
		$scope.parentid = parentid;
		var postData = {type: 'selectType',parentid:$scope.parentid};
	    $http.post('../../Controller/article/detailsArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
	    	$scope.Nodelist = result.data.list;
	    })
		$scope.category_id = category_id;
		if (is_slide == 0) {
	        $scope.is_slide = true;
	    } else {
	        $scope.is_slide = false;
	    }
		if (is_top == 1) {
	        $scope.is_top = true;
	    } else {
	        $scope.is_top = false;
	    }
		if (is_red == 1) {
	        $scope.is_red = true;
	    } else {
	        $scope.is_red = false;
	    }
		if (is_hot == 1) {
	        $scope.is_hot = true;
	    } else {
	        $scope.is_hot = false;
	    }
		$scope.orderby = orderby;
		$scope.link_url = link_url;
		$scope.call_index = call_index;
		$scope.zhaiyao = zhaiyao;
		$scope.click = click;
		$scope.seo_title = seo_title;
		$scope.seo_keywords = seo_keywords;
		$scope.seo_description = seo_description;
		$("#picture").val(Smallimg);
        $("#bigpicture").val(img_url);
		$("#imglist").attr("src",Smallimg);
		
	    $scope.save = function (type) {
	    	$scope.but = true;
	    	var id = $("#id").val();
	    	var title = $scope.title;
	    	var call_index = $scope.call_index;
	    	var category_id = $scope.category_id;
	    	var Smallimg = $("#picture").val();
	    	var is_slide = $scope.is_slide;
	    	var is_top = $scope.is_top;
	    	var is_red = $scope.is_red;
	    	var is_hot = $scope.is_hot;
	    	var orderby = $scope.orderby;
	    	var zhaiyao = $scope.zhaiyao;
	    	var click = $scope.click;
	    	var link_url = $scope.link_url;
	    	var content = $("#content").val();
	    	var seo_title = $scope.seo_title;
	    	var seo_keywords = $scope.seo_keywords;
	    	var seo_description = $scope.seo_description;
	    	if(type=="modify"){
	    		var postData = {
    	            type: 'modify',
    	            id: id,
    	            title: $scope.title,
    	            zhaiyao: zhaiyao,
    	            category_id: $scope.category_id,
    	            click:$scope.click,
    	            Smallimg:  Smallimg,
    	            img_url: $("#bigpicture").val(),
    	            call_index:$scope.call_index,
    	            content:content,
    	            is_slide: $scope.is_slide ? 1 : 0,
    	            is_top: $scope.is_top ? 1 : 0,
    	            is_red: $scope.is_red ? 1 : 0,
    	            is_hot: $scope.is_hot ? 1 : 0,
    	            orderby: $scope.orderby,
    	            seo_title: $scope.seo_title,
    	            seo_keywords: $scope.seo_keywords,
    	            seo_description: $scope.seo_description,
    	            link_url: $scope.link_url,
    	            state:1,
    	            valid:1
    	        };
	    	}else{
	    		var postData = {
    	            type: 'add',
    	            title: $scope.title,
    	            zhaiyao: zhaiyao,
    	            category_id: $scope.category_id,
    	            click:$scope.click,
    	            Smallimg:  Smallimg,
    	            img_url: $("#bigpicture").val(),
    	            call_index:$scope.call_index,
    	            content:content,
    	            is_slide: $scope.is_slide ? 1 : 0,
    	            is_top: $scope.is_top ? 1 : 0,
    	            is_red: $scope.is_red ? 1 : 0,
    	            is_hot: $scope.is_hot ? 1 : 0,
    	            orderby: $scope.orderby,
    	            seo_title: $scope.seo_title,
    	            seo_keywords: $scope.seo_keywords,
    	            seo_description: $scope.seo_description,
    	            link_url: $scope.link_url,
    	            state:1,
    	            valid:1
    	        };
	    	}
	    	$http.post('../../Controller/article/detailsArticleAction.php', postData).then(function (result) {  //正确请求成功时处理
	            if (result.data.code>0) {
	                var index = parent.layer.getFrameIndex(window.name);
	                parent.layer.close(index);
	                parent.layer.msg(result.data.message, {icon: 6, time: 1500});
	                parent.location.href='listarticle.php';
	                //parent.location.reload();
	            } else {
	            	$scope.but = false;
	                layer.msg(result.data.message, {time: 3000});
	            }
	        }).catch(function () { //捕捉错误处理
	        	$scope.but = false;
	            layer.msg('服务端请求错误！', {time: 3000});
	        });
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
	    $scope.changeClass = function (type) {
	    	if (type == 'is_slide') {
	            $scope.is_slide = !$scope.is_slide;
	        }
	    	if (type == 'is_top') {
	            $scope.is_top = !$scope.is_top;
	        }
	        if (type == 'is_red') {
	            $scope.is_red = !$scope.is_red;
	        }
	        if (type == 'is_hot') {
	            $scope.is_hot = !$scope.is_hot;
	        }
	    }
	});
$("#index").change(function(){
	$("#index").wrap("<form id='myupload' action='../../Controller/article/uploadfile.php' method='post' enctype='multipart/form-data'></form>");
	$("#myupload").ajaxSubmit({
        dataType: "json",//返回结果格式  
		success: function(result) {
			var json = result.data;
			var imgUrl = json.Smallimg;
            $("#index").unwrap();
            $("#picture").val(imgUrl);
            $("#bigpicture").val(json.filePath);
			$("#imglist").attr("src",imgUrl);
		}
	});
});
$(function(){
	/*tab切换*/
	layui.use('element', function(){
		var $ = layui.jquery,
		element = layui.element(); //Tab的切换功能，切换事件监听等，需要依赖element模块
	});
})