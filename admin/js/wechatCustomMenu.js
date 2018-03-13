/*
* @description: 自定义菜单
* @author: will
* @update: will (2017-07-01 15:40)
* @version: v1.0
*/
$(function(){
	/*自定义菜单*/
	$('.mbxx-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "自定义菜单编辑",//标题
			area: ['480px', 'auto'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".popup-zdycd"),//也可将html写在此处
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
	
	/*编辑成功，关闭弹层并提示*/
	$(".zdtcd-submit").on("click", function(){
		layer.closeAll('page'); //关闭弹层
		layer.msg('恭喜你，添加成功！',{icon: 6,time:1000});
	})
})