/*
* @description: 商品BOM列表js
* @author: will
* @update: will (2017-06-10 09:56)
* @version: v1.0
*/
$(function(){
	/*删除*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定删除该商品BOM吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	
	/*编辑*/
	$('.details-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '商品BOM编辑',
			area : ['100%' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsGoodsBom.html',
		});
	});
	
	/*弹出回收站*/
	$('.btn-delete').on('click', function(){
		layer.open({
		type: 2,
			title: '回收站',
			area : ['100%' , '100%'],
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'recycleListGoods.html',
		});
	});
	
	/*弹出标签打印*/
	$('.look-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '商品BOM',
			area : ['100%' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'lookGoodsBom.html',
		});
	});
});