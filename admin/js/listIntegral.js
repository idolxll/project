/*
* @description: 积分兑换js
* @author: will
* @update: will (2017-02-27 16:10)
* @version: v1.0
*/
$(function(){
	/*弹出积分兑换商品信息*/
	$('.check-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "兑换商品",//标题
			move: false,
			area: ['420px', '100%'],//宽高
			offset: ['0', '0'],
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".integral-popup"),//也可将html写在此处
		});
	});
})