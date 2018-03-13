/*
* @description: 成品出库js
* @author: will
* @update: will (2017-02-24 16:30)
* @version: v1.0
*/
$(function(){
	/*弹出编辑商品*/
	$('.news-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '出库商品编辑',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'editGoodsReceive.html',
		});
	});
	/*弹出成品详情*/
	$('.check-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '详情',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsGoodsReceive.html',
		});
	});
})
