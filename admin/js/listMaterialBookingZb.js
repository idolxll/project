/*
* @description: 原料预订js
* @author: will
* @update: will (2017-06-13 11:30)
* @version: v1.0
*/
$(function(){
	/*弹出预订单运营审核*/
	$('.yysh-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '运营审核',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'editMaterialBookingZb.html',
		});
	});
	/*单据汇总*/
	$(".djhz-btn").on("click", function(){
		layer.alert('亲，您确定汇总选中的原料预订单吗？', {
			icon: 3,
			title: "汇总提示",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('恭喜你，汇总成功，请查看原料汇总表！',{icon: 1,time:1500});
		});
	});
	/*财务审核*/
	$(".cwsh-btn").on("click", function(){
		layer.confirm('您确定通过该原料预订单审核吗？', {
			title: '审核提示',
	  		btn: ['确定','驳回'] //按钮
		}, function(){
	  		layer.msg('恭喜你，审核成功！', {icon: 1, time:1500});
		}, function(){
			layer.msg('该原料预订单已被你残忍拒绝！', {icon: 2, time:2000});
		});
	})
	
	/*弹出查看供应商详情*/
	$('.details-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '预订原料详情',
			area : ['100%' , '100%'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsMaterialBookingZb.html',
		});
	});
});