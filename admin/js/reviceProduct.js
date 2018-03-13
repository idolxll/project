var app = angular.module('myApp', []);
	app.controller('listController', function ($scope, $http) {
		$scope.status = false;
		$scope.is_hot = false;
		// var postData = {type: 'searchtype',typeid:$("#typeid").val()};
	 //    $http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
	 //    	$scope.typelist = result.data.list;
	 //    	console.log(result.data.list)
	 //    	if ($scope.typelist.status == 1) {
		//         $scope.is_hot = true;
		//     } else {
		//         $scope.is_hot = false;
		//     }
	 //    }).catch(function () { //捕捉错误处理
	 //        layer.msg('服务端请求错误！', {time: 3000});
	 //    });
	 //    var img = $("#bigpicture").val();
		// $scope.typename = typename;
		// $scope.typeid = typeid;
		// $scope.orderby = orderby;
		// $("#bigpicture").val(img);
		$scope.save = function () {
	    	$scope.but = true;
	    	 var zjm=makePy($("#typename").val());//返回的是一个数组 
        	zjm=zjm[0];//获取第一个助记码  
        	var initial=zjm.toString().slice(0,1);
	    	var typeid = $("#typeid").val();
	    	var typename = $("#typename").val();
	    	var orderby = $("#orderby").val();
	    	var is_hot = $scope.is_hot;
	    	var img = $("#bigpicture").val();
	    	var postData = {
	    		type:"add",
	    		img: img,
	    		typeid:typeid,
    	        typename:typename,
    	        initial:initial,
    	        orderby: orderby,
    	        is_hot: $scope.is_hot ? 1 : 0,
    	    };
	    	$http.post('../../Controller/product/ProductCategoryAction.php', postData).then(function (result) {  //正确请求成功时处理
	            if (result.data.code>0) {
	                var index = parent.layer.getFrameIndex(window.name);
	                parent.layer.close(index);
	                parent.layer.msg(result.data.message, {icon: 6, time: 1500});
	                //parent.location.href='listproduct.php';
	                parent.location.reload();
	            } else {
	            	$scope.but = false;
	                layer.msg(result.data.message, {time: 3000});
	            }
	        }).catch(function () { //捕捉错误处理
	        	$scope.but = false;
	            layer.msg('服务端请求错误！', {time: 3000});
	        });
	    }
	    $scope.changeClass = function (type) {
	    	if (type == 'status') {
	            $scope.status = !$scope.status;
	        }
	        if (type == 'is_hot') {
	            $scope.is_hot = !$scope.is_hot;
	        }
	    }
	    $scope.resave = function () {
	    	$("#typename").val("");
	    	$("#orderby").val("");
			$scope.is_hot = false;
	    }
	    // $scope.isUpload = false;
     //    $scope.reader = new FileReader(); 
     //    $scope.img_upload = function (files) {   
     //        var type=files[0].type;
     //        var size=((files[0].size /1024)/1024).toFixed(0);
     //        if(size>=1){
     //            layer.msg('上传的图片请控制在1M以内！', {time: 3000});
     //            return  ;
     //        }
     //        if(type!='image/png' && type!='image/jpg'&& type!='image/jpeg'){
     //            layer.msg("请上传PNG/JPG/JPEG图片格式", {time: 3000});
     //            return false;
     //        }
     //        $scope.isUpload = true;
     //        $scope.guid = (new Date()).valueOf();   //通过时间戳创建一个随机数，作为键名使用
     //        $scope.reader.readAsDataURL(files[0]);  //FileReader的方法，把图片转成base64
     //        $scope.reader.onload = function (ev) {
     //            var postData = {
     //                type: '2',
     //                img: $scope.guid,
     //                imgPath: ev.target.result,
     //            };
     //            $http.post('../../Controller/cashier/upload.php', postData).then(function (result) {  //正确请求成功时处理
     //                var id = 'img' + $scope.guid;
     //                if (result.data.success) {
     //                    var imgUrl = result.data.result[id].url;
     //                    $('#picture2').val(imgUrl);
     //                    var attstr = '<img style="width:400px;height:auto;" src="' + imgUrl + '">';
     //                    $('#uploading').html(attstr);
     //                } else {
     //                    layer.msg(result.data.message, {time: 3000});
     //                }
     //            }).catch(function () { //捕捉错误处理
     //                layer.msg('上传图片格式有误,请换张图片再试！', {time: 3000});
     //            });
     //        };
     //    }
$("#index").change(function(){
	$("#index").wrap("<form id='myupload' action='../../Controller/product/uploadfile.php' method='post' enctype='multipart/form-data'></form>");
	$("#myupload").ajaxSubmit({
        dataType: "json",//返回结果格式  
		success: function(result) {
			var json = result.data;
			var imgUrl = json.Smallimg;
            $("#index").unwrap();
            $("#picture").val(imgUrl);
            $("#bigpicture").val(json.filePath);
			$("#imglist").attr("src",imgUrl);
			console.log(imgUrl)
		}
	});
})
})