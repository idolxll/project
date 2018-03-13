/*
* @description: 原料预订js
* @author: will
* @update: will (2017-06-13 11:30)
* @version: v1.0
*/
$(function(){
	/*删除未入库采购单据*/
	$(".goods-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该原料预订单吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	
	/*预订*/
	$(".yuding-btn").on("click", function(){
		layer.alert('亲，您确定提交该原料预订单吗？', {
			icon: 3,
			title: "提交",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('提交成功！',{icon: 1,time:1000});
		});
	});
	
	/*弹出编辑供应商*/
	$('.news-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '预订原料编辑',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'editMaterialBookingFd.html',
		});
	});
	
	/*弹出原料预订入库*/
	$('.ruku-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '预订原料入库',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'MaterialBookingStorage.html',
		});
	});
	
	/*弹出查看供应商详情*/
	$('.details-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '预订原料详情',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsMaterialBookingFd.html',
		});
	});
});