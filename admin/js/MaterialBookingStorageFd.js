/*
* @description: 原料预订入库js
* @author: will
* @update: will (2017-06-13 15:40)
* @version: v1.0
*/
$(function(){
	/*保存*/
	$(".put-btn").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，入库成功！',{icon: 6,time:1500});
	})
})
