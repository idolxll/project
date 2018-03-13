/*
* @description: 客流宝js
* @author: will
* @update: will (2017-02-22 11:10)
* @version: v1.0
*/
$(function(){
	/*删除选中的商品提示*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定删除选中的原料吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	
	/*弹出编辑原料*/
	$('.details-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '添加客流宝',
			area : ['470px' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsKlb.html',
		});
	});
});