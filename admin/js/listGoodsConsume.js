/*
* @description: 消费列表js
* @author: will
* @update: will (2017-02-24 16:30)
* @version: v1.0
*/
$(function(){
	/*弹出购买明细*/
	$('.view-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "购买明细",//标题
			move: false,
			area: ['450px', '100%'],//宽高
			offset: ['0', '0'],
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".view-open"),//也可将html写在此处
		});
	});
})
