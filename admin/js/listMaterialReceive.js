/*
* @description: 原料领用-新增单据js
* @author: will
* @update: will (2017-02-24 16:30)
* @version: v1.0
*/
$(function(){
	/*弹出编辑商品*/
	$('.news-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '领用原料编辑',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'editMaterialReceive.html',
		});
	});
	/*弹出原料详情*/
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
			content: 'detailsMaterialReceive.html',
		});
	});
})
