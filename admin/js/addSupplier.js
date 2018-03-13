/*
* @description: 编辑供应商js
* @author: will
* @update: will (2017-03-16 15:40)
* @version: v1.0
*/
$(function(){
	/*开关*/
	$(".will-check input").click(function(){
		if ($(this).is(":checked")) {
			$(this).parent("div").addClass("active");
		}else {
			$(this).parent("div").removeClass("active");
		}
	})
	
	$('.article-button').on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，新增供应商成功！',{icon: 6,time:1500});
	})
})