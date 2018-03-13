/*
* @description: 编辑产品js
* @author: billy
* @update: billy (2018-03-16 15:40)
* @version: v1.0
*/
var day_i = count ? count : 0; 
var app = angular.module('myApp', []);
	app.controller('listController', function ($scope, $http) {
		$scope.status = false;
		$scope.is_top = false; 
		$scope.is_red = false;
		$scope.is_hot = false;
		$scope.addNum = false;
		if(count>0){
			$scope.reduceNum = false;
		}else{
			$scope.reduceNum = true;
		}
        $scope.num = count ? count : 0; 
		var postData = {type: 'searchtype',falg:"3"};
	    $http.post('../../Controller/product/detailsProductAction.php', postData).then(function (result) {  //正确请求成功时处理
	    	$scope.list = result.data.list;
	    }).catch(function () { //捕捉错误处理
	        layer.msg('服务端请求错误！', {time: 3000});
	    });
	    $scope.productname = productname;
	    //$("#productno").val(productno);
		$scope.parentid = parentid;
		var postData = {type: 'selectType',parentid:$scope.parentid};
	    $http.post('../../Controller/product/detailsProductAction.php', postData).then(function (result) {  //正确请求成功时处理
	    	$scope.Nodelist = result.data.list;
	    })
		$scope.typeid = typeid;
		$("#picture").val(img);
		if (status == 0) {
	        $scope.status = true;
	    } else {
	        $scope.status = false;
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
		$scope.sn = sn;
		$scope.price = price;
		$scope.market = market;
		$scope.Share_amount = Share_amount;
		$scope.sales = sales;
		$scope.xcdays = xcdays;
		$scope.jtfs = jtfs;
		$scope.seo_title = seo_title;
		$scope.seo_keywords = seo_keywords;
		$scope.seo_description = seo_description;
		$scope.sn = sn;
		$scope.type = type
		$scope.month = month;
		$scope.ftfs = ftfs;
		$("#picture").val(Smallimg);
        $("#bigpicture").val(img);
		$("#imglist").attr("src",Smallimg);
		$scope.save = function (type) {
			$scope.but = true;
	    	var productid = $("#productid").val();
	    	var productname = $scope.productname;
	    	var productno = $("#productno").val();
	    	var typeid = $scope.typeid;
	    	var img = $("#bigpicture").val();
	    	var thumbnail = $("#picture").val();
	    	var status = $scope.status;
	    	var is_top = $scope.is_top;
	    	var is_red = $scope.is_red;
	    	var is_hot = $scope.is_hot;
	    	var sn = $scope.sn;
	    	var price = $scope.price;
	    	var market = $scope.market ? $scope.market : 0;
	    	var Share_amount = $scope.Share_amount;
	    	var sales = $scope.sales;
	    	var xcdays = $scope.xcdays;
	    	var jtfs = $scope.jtfs;
	    	var ftfs = $scope.ftfs;
	    	var description = $("#description").val();
	    	var xcts = $("#xcts").val();
	    	var instructions = $("#instructions").val();
	    	var recommend = $("#recommend").val();
	    	var month = $scope.month;
	    	$scope.detailid = [];
	    	$scope.linedaytitlelist = [];
	    	$scope.linetitlelist = [];
	    	$scope.linedaylist = [];
	    	//行程天数
	    	for(var j=0;j<day_i;j++){
	    		$scope.linedaytitlelist.push($("#linedaytitle"+j).val());
	    		$scope.linetitlelist.push($("#linetitle"+j).val());
	    		$scope.linedaylist.push($("#lineday"+j).val());
	    		if($("#detailid"+j).val()!=""){
	    			$scope.detailid.push($("#detailid"+j).val());
    			}
	    	}
	    	var seo_title = $scope.seo_title;
	    	var seo_keywords = $scope.seo_keywords;
	    	var seo_description = $scope.seo_description;
	    	if(type=="modify"){
	    		var postData = {
    	            type: 'modify',
    	            productid: productid,
    	            productname: $scope.productname,
    	            productno: productno,
    	            typeid: $scope.typeid,
    	            price:$scope.price,
    	            thumbnail:  thumbnail,
    	            img: img,
    	            market:$scope.market,
    	            Share_amount:Share_amount,
    	            status: $scope.status ? 0 : 1,
    	            is_top: $scope.is_top ? 1 : 0,
    	            is_red: $scope.is_red ? 1 : 0,
    	            is_hot: $scope.is_hot ? 1 : 0,
    	            sn: $scope.sn,
    	            seo_title: $scope.seo_title,
    	            seo_keywords: $scope.seo_keywords,
    	            seo_description: $scope.seo_description,
    	            xcdays: $scope.xcdays,
    	            jtfs: $scope.jtfs,
    	            ftfs: $scope.ftfs,
    	            description:description,
    	            xcts: xcts,
    	            instructions: instructions,
    	            sales: $scope.sales,
    	            recommend:recommend,
    	            month:month,
    	            ptype:3,
    	            state:1,
    	            valid:1,
    	            detailid:$scope.detailid,
    	            linedaytitlelist:$scope.linedaytitlelist,
    	            linetitlelist:$scope.linetitlelist,
    	            linedaylist:$scope.linedaylist
    	        };
	    	}else{
	    		var postData = {
    	            type: 'add',
    	            productname: $scope.productname,
    	            productno: productno,
    	            typeid: $scope.typeid,
    	            price:$scope.price,
    	            thumbnail:  thumbnail,
    	            img: img,
    	            market:$scope.market,
    	            Share_amount:Share_amount,
    	            status: $scope.status ? 0 : 1,
    	            is_top: $scope.is_top ? 1 : 0,
    	            is_red: $scope.is_red ? 1 : 0,
    	            is_hot: $scope.is_hot ? 1 : 0,
    	            sn: $scope.sn,
    	            seo_title: $scope.seo_title,
    	            seo_keywords: $scope.seo_keywords,
    	            seo_description: $scope.seo_description,
    	            xcdays: $scope.xcdays,
    	            jtfs: $scope.jtfs,
    	            ftfs: $scope.ftfs,
    	            description:description,
    	            xcts: xcts,
    	            instructions: instructions,
    	            sales: $scope.sales,
    	            recommend:recommend,
    	            month:month,
    	            ptype:3,
    	            state:1,
    	            valid:1,
    	            linedaytitlelist:$scope.linedaytitlelist,
    	            linetitlelist:$scope.linetitlelist,
    	            linedaylist:$scope.linedaylist
    	        };
	    	}
	    	$http.post('../../Controller/product/detailsProductAction.php', postData).then(function (result) {  //正确请求成功时处理
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
	    $scope.selectType = function (){
	    	var parentid = $scope.parentid;
	    	var postData = {type: 'selectType',parentid:parentid};
	        $http.post('../../Controller/product/detailsProductAction.php', postData).then(function (result) {  //正确请求成功时处理
	        	$scope.Nodelist = result.data.list;
	        }).catch(function () { //捕捉错误处理
	            layer.msg('服务端请求错误！', {time: 3000});
	        });
	    }
	    $scope.changeClass = function (type) {
	    	if (type == 'status') {
	            $scope.status = !$scope.status;
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
	    $scope.resave = function () {
	    	$scope.seo_description = "";
	    	$scope.seo_keywords = "";
	    	$scope.seo_title = "";
	    	$scope.jtfs = "";
	    	$scope.ftfs = "";
	    	$scope.xcdays = "";
	    	$scope.month = "";
	    	$scope.sales = "";
	    	$scope.Share_amount = "";
	    	$scope.price = "";
	    	$("#recommend").val("");
	    	$scope.typeid = "";
	    	$scope.parentid = "";
	    	$("#productno").val("");
	    	$scope.productname = "";
	    	$scope.status = false;
			$scope.is_top = false; 
			$scope.is_red = false;
			$scope.is_hot = false;
	    }
	    $scope.adddaytr = function(Boole) {
	        if (day_i >= 15) {
	        	layer.msg("最多只能添加15天", {time: 3000});
	            return;
	        }
	        if (Boole) {
	        	addrow(day_i,day_i+1);
	            createKindEditor(day_i);
	            $scope.num = $scope.num + 1;
	            $scope.reduceNum = false;
	            if ($scope.num == 16) {
	                $scope.addNum = true;
	            } else {
	                $scope.addNum = false;
	            }
	            day_i++;
	        } else {
	        	$("#list"+day_i).remove();
	        	day_i--;
	            $scope.addNum = false;
	            $scope.num = $scope.num - 1;
	            if ($scope.num == 0) {
	                $scope.reduceNum = true;
	            } else {
	                $scope.reduceNum = false;
	            }
	        }
	    }
	});
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
		}
	});
});
$("#moreimg").change(function(){
	$("#moreimg").wrap("<form id='imglistupload' action='../../Controller/product/uploadfile.php?action=more' method='post' enctype='multipart/form-data'></form>");
	$("#imglistupload").ajaxSubmit({
        dataType: "json",//返回结果格式  
		success: function(result) {
			var json = result.data;
			var imgUrlstr = json.filePath;
			var arr = imgUrlstr.split(",");
            $("#moreimg").unwrap();
            $("#picturestr").val(imgUrlstr);
            var str = "";
            for(var i = 0; i<arr.length; i++){
            	str +='<div class="will-form-file" style="margin-left: 10px;">';
            	str +='<img src="'+arr[i]+'">';
            	str +='</div>';
            }
            $("#listimg").html(str);
		}
	});
});
var datestr = "";
function checkdate(tdate) {
    var arrdate = datestr.split("|");
    for (var i = 0; i < arrdate.length; i++) {
        if (tdate == arrdate[i])
            return true;
    }
    return false;
}
function adddaterows() {
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    var aduit_price = $("#money").val();
    if(aduit_price==""){
    	layer.msg('请输入价格',{icon: 5,time:1000});
    	return false;
    }
    var interval = daysBetween(startdate, enddate);
    var startdate2 = startdate.replace(/-/g, "/");
    var rowhtml = "";
    for (var i = 0; i < interval + 1; i++) {
        var sdate = new Date(startdate2);
        var currdate = GetDateStr(sdate, i);
        //var isadd = adddaterow(0, currdate, aduit_price);
        /*var a = document.getElementById("date" + currdate);
        if (a != null) {
            return false;//存在控件
        }*/
        rowhtml += "<tr>" +
	        "<td align=\"center\">" +
	            "<input id=\"rowid\" name=\"rowid\" type=\"hidden\" />" +
	            "<input id=\"date" + currdate + "\" name=\"date\" type=\"text\" value=\"" + currdate + "\" class=\"textbox\" size=\"12\" onclick='WdatePicker({dateFmt:\"yyyy-MM-dd\"})' />" +
	        "</td>" +
	        "<td align=\"center\">" +
	            "￥<input id=\"aduit_price" + currdate + "\" name=\"aduit_price\" type=\"text\" class=\"textbox\" size=\"8\" value=\"" + aduit_price + "\"/>" +
	        "</td>" +
	        "<td align=\"center\">" +
	            "￥<input id=\"market_aduitprice" + currdate + "\" name=\"market_aduitprice\" type=\"text\" class=\"textbox\" size=\"8\" value=\"" + market_aduitprice + "\"/>" +
	        "</td>" +
	        "<td align=\"center\" width=\"80\">" +
	            "<a href=\"javascript:void(0);\" onclick=\"deldaterow(this,'" + currdate + "');\">删除</a>" +
	        "</td>" +
	    "</tr>";
    }
    $("#list").html(rowhtml);
}
function daysBetween(DateOne, DateTwo) {
    var OneMonth = DateOne.substring(5, DateOne.lastIndexOf('-'));
    var OneDay = DateOne.substring(DateOne.length, DateOne.lastIndexOf('-') + 1);
    var OneYear = DateOne.substring(0, DateOne.indexOf('-'));
    var TwoMonth = DateTwo.substring(5, DateTwo.lastIndexOf('-'));
    var TwoDay = DateTwo.substring(DateTwo.length, DateTwo.lastIndexOf('-') + 1);
    var TwoYear = DateTwo.substring(0, DateTwo.indexOf('-'));
    var cha = ((Date.parse(OneMonth + '/' + OneDay + '/' + OneYear) - Date.parse(TwoMonth + '/' + TwoDay + '/' + TwoYear)) / 86400000);
    return Math.abs(cha);
}
function deldaterow(k,deldate) {
    $(k).parent().parent().remove();
}
function GetDateStr(dd, AddDayCount) {
    dd.setDate(dd.getDate() + AddDayCount); //获取AddDayCount天后的日期
    var y = dd.getFullYear();
    var m = dd.getMonth() + 1; //获取当前月份的日期
    var d = dd.getDate();
    if(d<10){
    	d="0"+d;
    }
    if(m<10){
    	m="0"+m;
    }
    return y + "-" + m + "-" + d;
}
$(function(){
	/*tab切换*/
	layui.use('element', function(){
		var $ = layui.jquery,
		element = layui.element(); //Tab的切换功能，切换事件监听等，需要依赖element模块
	});
	/*弹出编辑商品*/
	$('.combo-select').on('click', function(){
		layer.open({
		type: 2,
			title: '添加商品',
			area : ['800px' , '84%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			content: 'addGoodsCombo.html',
		});
	});
	
	/*删除商品提示*/
	$(".goods-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该商品吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
})
function addrow(i,j) {
    day_i = i;
    var trhtml = '<div class="combo-item" id="list' + j + '" >' +
            '<div class="layui-form-item" style="margin-bottom: 10px;">' +
            '<label class="layui-form-label">行程标题</label>' +
            '<div class="layui-input-inline" style="width: 400px;">' +
            '<input type="text" class="layui-input" id="linedaytitle' + i + '" placeholder="请输入标题" autocomplete="off" /></div></div>' +
            '<div class="layui-form-item" style="margin-bottom: 10px;"><div class="layui-inline">' +
            '<label class="layui-form-label">行程概要</label>' +
            '<div class="layui-input-inline" style="width: 400px;">' +
            '<input type="text"  class="layui-input" id="linetitle' + i + '" placeholder="请输入行程概要" />' +
            '</div></div></div>' +
            '<div class="con-table"><label class="layui-form-label">第&nbsp;' + j + '&nbsp;天&nbsp;&nbsp;</label><textarea id="lineday' + i + '" name="lineday' + i + '" rows="8" style="width:700px;height:200px;visibility:hidden;"></textarea></div></div>';
    $(".combo-list").append(trhtml);
}
function createKindEditor(i) {
    KindEditor.create('#lineday' + i, {
        width: '95%',
        height: '260px',
        resizeType: 1,
        allowFileManager: true,
        allowPreviewEmoticons: false,
        allowImageUpload: true,
        cssPath : '../../kindeditor/plugins/code/prettify.css',
		uploadJson : '../../kindeditor/php/upload_json.php',
		fileManagerJson : '../../kindeditor/php/file_manager_json.php',
		afterBlur: function(){this.sync();}//假如没有这一句，获取到的id为content的值空白
    });
}