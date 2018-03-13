/*
* @description: 其他费用支出js
* @author: will
* @update: will (2017-02-24 16:30)
* @version: v1.0
*/
$(function(){
	$('.news-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '添加收支项目',
			area : ['460px' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'addOtherFiles.html',
		});
	});
	/*选项卡*/
	layui.use('element', function(){
		var element = layui.element();
	});
})
