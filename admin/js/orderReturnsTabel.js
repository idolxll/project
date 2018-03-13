/*
* @description: 订单汇总js
* @author: will
* @update: will (2017-03-30 17:30)
* @version: v1.0
*/
$(function(){
	/*订单详情*/
	$('.check-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '退货单详情',
			area : ['460px' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: 't',
			offset: 'l',
			content: 'detailsOrderReturns.html',
		});
	});
})