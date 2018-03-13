/*
* @description: 组合套餐列表js
* @author: will
* @update: will (2017-02-22 11:10)
* @version: v1.0
*/
$(function(){
	/*删除选中的套餐提示*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定删除选中的套餐吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*删除单一套餐提示*/
	$(".goods-delbtn").on("click", function(){
		layer.alert('亲，您确定删除该套餐吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
	/*下架选中的套餐提示*/
	$(".xj-btn").on("click", function(){
		layer.alert('亲，您确定下架选中的套餐吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "下架",
		}, function(index){
			layer.msg('下架成功！',{icon: 6,time:1000});
		});
	});
	/*下架单一套餐提示*/
	$(".txj-btn").on("click", function(){
		layer.alert('亲，您确定下架该套餐吗？', {
			icon: 5,
			resize: false, //禁止拉伸
			title: "下架",
		}, function(index){
			layer.msg('下架成功！',{icon: 6,time:1000});
		});
	});
	/*上架单一套餐提示*/
	$(".tsj-btn").on("click", function(){
		layer.alert('亲，您确定将该套餐重新上架吗？', {
			icon: 3,
			resize: false, //禁止拉伸
			title: "上架",
		}, function(index){
			layer.msg('上架成功！',{icon: 6,time:1000});
		});
	});
	
	/*弹出编辑套餐*/
	$('.details-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '线路编辑',
			area : ['100%' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'detailsProduct.php',
		});
	});
	
	/*弹出回收站*/
	$('.btn-delete').on('click', function(){
		layer.open({
		type: 2,
			title: '回收站',
			area : ['100%' , '100%'],
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'recycleListGoodsCombo.php',
		});
	});
	
	/*弹出商品价格调控*/
	$('.price-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '套餐价格调控',
			area : ['820px' , '500px'],
			anim: '0',
			resize: false,
			move: false,
			shadeClose: true,
			content: 'comboPriceControl.php',
		});
	});
	
	/*弹出标签打印*/
	$('.print-btn').on('click', function(){
		layer.open({
		type: 2,
			title: '商品标签打印',
			area : ['400px' , '100%'],
			anim: '2',
			resize: false,
			move: false,
			shadeClose: true,
			offset: ['0', '0'],
			content: 'printLabelCombo.php',
		});
	});
});