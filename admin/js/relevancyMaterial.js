/*
* @description: 关联原料js
* @author: will
* @update: will (2017-05-19 16:30)
* @version: v1.0
*/
$(function(){
	/*添加成功关闭弹窗*/
	$(".add-submit").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，关联成功！',{icon: 6,time:1500});
	})
})
