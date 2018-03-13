/*
* @description: 支付方式列表js
* @author: will
* @update: will (2017-05-23 10:10)
* @version: v1.0
*/
$(function(){
	/*删除结算方式提示*/
	$(".jsfs-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该支付方式吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*关闭结算方式提示*/
	$(".txj-btn").on("click", function(){
		layer.alert('亲，您确定关闭该支付方式吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "关闭",
		}, function(index){
			layer.msg('关闭成功！',{icon: 6,time:1000});
		});
	});
	/*启用结算方式提示*/
	$(".tsj-btn").on("click", function(){
		layer.alert('亲，您确定将该支付方式重新启用吗？', {
			icon: 3,
			resize: false, //禁止拉伸
			title: "启用",
		}, function(index){
			layer.msg('启用成功！',{icon: 6,time:1000});
		});
	});
	
	/*弹出添加结算方式*/
	$('.add-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "添加支付方式",//标题
			area: ['300px', '190px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".jsfs-popup"),//也可将html写在此处
		});
	});
	/*区域添加成功，关闭弹层并提示*/
	$(".js-submit").on("click", function(){
		layer.closeAll('page'); //关闭弹层
		layer.msg('恭喜你，添加成功！',{icon: 6,time:1000});
	});
});