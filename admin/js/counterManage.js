/*
* @description: 桌台管理
* @author: will
* @update: will (2017-02-22 11:10)
* @version: v1.0
*/
$(function(){
	$(".counter-qy ul").find("li").click(function(){
		if ($(this).find("input[type=radio]").is(":checked")) {
			$(this).siblings('li').removeClass('active');
			$(this).addClass("active");
		}
	})
	/*删除选中的区域提示*/
	$(".delqy-btn").on("click", function(){
		layer.alert('亲，您确定删除选中的区域？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	
	/*删除选中的桌台提示*/
	$(".delzt-btn").on("click", function(){
		layer.alert('亲，您确定删除选中的桌台？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	
	/*弹出添加区域*/
	$('.addqy-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "添加桌台区域",//标题
			area: ['275px', '190px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".addqy-popup"),//也可将html写在此处
		});
	});
	/*区域添加成功，关闭弹层并提示*/
	$(".qy-submit").on("click", function(){
		layer.closeAll('page'); //关闭弹层
		layer.msg('恭喜你，添加成功！',{icon: 6,time:1000});
	});
	
	/*弹出添加桌台*/
	$('.addzt-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "添加桌台",//标题
			area: ['400px', '190px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".addzt-popup"),//也可将html写在此处
		});
	});
	/*区域添加成功，关闭弹层并提示*/
	$(".zt-submit").on("click", function(){
		layer.closeAll('page'); //关闭弹层
		layer.msg('恭喜你，添加成功！',{icon: 6,time:1000});
	});
	
	/*弹出二维码*/
	$('.ewm-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '桌台二维码',
			area : ['300px' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'qrCode.html',
		});
	});
});