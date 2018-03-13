/*
* @description: 商品采购管理js
* @author: will
* @update: will (2017-05-16 17:00)
* @version: v1.0
*/
$(function(){
	/*删除未入库采购单据*/
	$(".goods-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该商品采购单吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	
	$('.ruku-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "采购入库",//标题
			area: ['440px', '230px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".ruku-popup"),//也可将html写在此处
		});
	});
	
	$(".ruku-baocun").on("click", function(){
		layer.closeAll('page'); //关闭弹层
		parent.layer.msg('恭喜你，入库成功！',{icon: 6,time:1500});
	})
	
	/*弹出编辑采购商品*/
	$('.news-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '采购商品编辑',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'editGoodsProcurement.html',
		});
	});
	/*弹出查看采购商品详情*/
	$('.details-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '采购商品',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsGoodsProcurement.html',
		});
	});
});