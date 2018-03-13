/*
* @description: 添加副屏
* @author: will
* @update: will (2017-03-16 15:40)
* @version: v1.0
*/
$(function(){
	$(".add-btn").click(function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，添加成功！',{icon: 6,time:1500});
	})
	
	/*开关*/
	$(".will-check input").click(function(){
		if ($(this).is(":checked")) {
			$(this).parent("div").addClass("active");
		}else {
			$(this).parent("div").removeClass("active");
		}
	})
})