/*
* @description: 原料预订js
* @author: will
* @update: will (2017-06-13 14:00)
* @version: v1.0
*/
$(function(){
	/*删除*/
	$(".del-btn").on("click", function(){
	    layer.alert('亲，您确定删除选中的原料吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
			}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	})
	
	/*弹出编辑原料*/
	$('.psi-select').on('click', function(){
		layer.open({
		type: 2,
			title: '添加原料',
			area : ['70%' , '84%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			content: 'addGoodsBookingFd.html',
		});
	});
	/*保存*/
	$(".put-btn").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，保存成功！',{icon: 6,time:1500});
	})
	/*预订*/
	$(".submit-btn").on("click", function(){
		layer.confirm('您确定向总部提交预订吗？', {
			title: '确认提示',
	  		btn: ['确定','取消'] //按钮
		}, function(){
	  		var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
			parent.layer.msg('恭喜你，提交成功！',{icon: 6,time:1500});
		});
	})
})
