/*
* @description: 单位管理js
* @author: will
* @update: will (2017-02-22 10:10)
* @version: v1.0
*/
$(function(){
	/*弹出新建单位*/
	$('.new-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "添加单位",//标题
			area: ['250px', '150px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".new-open"),//也可将html写在此处
		});
	});
	
	/*添加成功，关闭弹层并提示*/
	$(".unit-btn").on("click", function(){
		var name = $("#name").val();
		if (name == "") {
			layer.msg('请输入单位名称！',{time:1500});
		}else {
			layer.closeAll('page'); //关闭弹层
			layer.msg('恭喜你，添加成功！',{icon: 6,time:1000});
		}
	})

	/*停用提示*/
	$(".disable-btn").on("click", function(){
		layer.alert('亲，您确定停用该单位吗？', {
			icon: 5,
			title: "停用",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('停用成功！',{icon: 6,time:1000});
		});
	});
})
