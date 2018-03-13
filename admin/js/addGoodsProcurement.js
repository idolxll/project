/*
* @description: 商品采购-添加商品js
* @author: will
* @update: will (2017-06-13 15:00)
* @version: v1.0
*/
$(function(){
	/*添加成功关闭弹窗*/
	$(".add-submit").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，添加成功！',{icon: 6,time:1500});
	})
})
