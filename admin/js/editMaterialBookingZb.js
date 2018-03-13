/*
* @description: 原料预订js
* @author: will
* @update: will (2017-06-13 14:00)
* @version: v1.0
*/
$(function(){
	/*驳回*/
	$(".bh-btn").on("click", function(){
	    layer.alert('亲，您确定驳回该预订单吗？', {
			icon: 5,
			title: "驳回",
			resize: false, //禁止拉伸
			}, function(index){
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
			parent.layer.msg('已驳回！',{icon: 6,time:1500});
		});
	})
	
	/*审核通过*/
	$(".put-btn").on("click", function(){
	    layer.alert('亲，您确定通过该预订单审核吗？', {
			icon: 3,
			title: "驳回",
			resize: false, //禁止拉伸
			}, function(index){
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
			parent.layer.msg('恭喜你，审核成功！',{icon: 1,time:1500});
		});
	})
})
