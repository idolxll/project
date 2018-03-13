/*
* @description: 供应商品
* @author: will
* @update: will (2017-06-12 10:50)
* @version: v1.0
*/
$(function(){
	/*删除*/
	$(".del-btn").on("click", function(){
	    layer.alert('亲，您确定将选中的供应商品取消关联吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
			}, function(index){
			layer.msg('取消关联成功！',{icon: 6,time:1000});
		});
	})
	
	/*弹出编辑商品*/
	$('.psi-select').on('click', function(){
		layer.open({
		type: 2,
			title: '添加商品',
			area : ['70%' , '84%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			content: 'relevancyGoods.html',
		});
	});
})
