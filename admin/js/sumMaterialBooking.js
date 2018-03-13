/*
* @description: 原料预订汇总单js
* @author: will
* @update: will (2017-06-15 10:30)
* @version: v1.0
*/
$(function(){
	/*弹出预订汇总单门店预订单*/
	$('.ylydd-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '门店原料预订单',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'storeMaterialBooking.html',
		});
	});
	
	/*弹出查看预订原料汇总*/
	$('.hzyl-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '预订汇总原料',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'sumMaterial.html',
		});
	});
});