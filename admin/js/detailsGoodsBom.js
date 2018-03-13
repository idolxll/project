/*
* @description: 商品BOM编辑
* @author: will
* @update: will (2017-06-10 11:50)
* @version: v1.0
*/
$(function(){
	/*弹出编辑商品*/
	$('.goods-select').on('click', function(){
		layer.open({
		type: 2,
			title: '添加商品',
			area : ['800px' , '84%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			content: 'addGoodsBom.html',
		});
	});
	/*弹出编辑原料*/
	$('.bom-select').on('click', function(){
		layer.open({
		type: 2,
			title: '添加原料',
			area : ['70%' , '84%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			content: 'addMaterialBom.html',
		});
	});
	/*添加成功关闭弹窗*/
	$(".details-button").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，入库成功！',{icon: 6,time:1500});
	})
})
