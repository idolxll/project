/*
* @description: 礼品券js
* @author: will
* @update: will (2017-02-22 10:10)
* @version: v1.0
*/
$(function(){
	/*新增、编辑礼品券*/
	$('.new-btn').on('click', function(){
		layer.open({
			type: 2,
			title: "编辑礼品券",//标题
			area: ['516px', '100%'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			offset: ['0', '0'],
			content: 'detailsLipinquan.html',
		});
	});
	
	/*添加成功，关闭弹层并提示*/
	$(".baocun-btn").on("click", function(){
		layer.closeAll('page'); //关闭弹层
		layer.msg('恭喜你，代金券生成成功！',{icon: 6,time:1000});
	})
	
	/*查看使用名单*/
	$('.employ-btn').on('click', function(){
		layer.open({
			type: 2,
			title: "礼品券使用名单",//标题
			area: ['100%', '100%'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			offset: ['0', '0'],
			content: 'employLipinquan.html',
		});
	});
	
	/*查看使用门店*/
	$('.store-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "适用门店",//标题
			area: ['360px', '100%'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			offset: ['0', '0'],
			content: $(".store-open"),//也可将html写在此处
		});
	});
	
	/*查看使用须知*/
	$('.syxz-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "使用须知",//标题
			area: ['360px', '100%'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			offset: ['0', '0'],
			content: $(".syxz-open"),//也可将html写在此处
		});
	});
})
