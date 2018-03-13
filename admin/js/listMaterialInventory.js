/*
* @description: 原料库存js
* @author: will
* @update: will (2017-02-24 16:30)
* @version: v1.0
*/
$(function(){
	/*弹出原料库存详情*/
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
			content: 'detailsMaterialInventory.html',
		});
	});
})
