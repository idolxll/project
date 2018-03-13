/*
* @description: 模板消息
* @author: will
* @update: will (2017-07-01 15:40)
* @version: v1.0
*/
$(function(){
	/*新增模板消息*/
	$('.mbxx-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "模板消息编辑",//标题
			area: ['500px', '275px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".popup-mbxx"),//也可将html写在此处
		});
	});
	/*删除提示*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定把我删了吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
})