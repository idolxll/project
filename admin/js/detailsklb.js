/*
* @description: 客流宝-编辑
* @author: will
* @update: will (2017-03-16 15:40)
* @version: v1.0
*/
$(function(){
	$('.details-btn').on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，保存成功！',{icon: 6,time:1500});
	})
})