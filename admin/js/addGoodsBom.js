/*
* @description: 商品BOM-添加商品js
* @author: will
* @update: will (2017-03-24 19:00)
* @version: v1.0
*/
$(function(){
	/*选择商品*/
	$(".add-submit").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('已选择！',{icon: 1,time:1500});
	})
})
