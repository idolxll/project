/*
* @description: 编辑商品js
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
	
	$("table.detail-table").click(function(e) {
       if (e.target.className=="del-tab"){
            $(e.target).parents("tr").remove();
       };
   	});
	
	$(".add-tab").click(function(){
		var len=$("table.detail-table tr").length;
		$("table").append(
			'<tr class="text-c" id='+len+'>'+
			'<td><input type="text" class="layui-input" id="goods-ge'+len+'" placeholder="规格"></td>'+
			'<td><input type="text" class="layui-input" id="pur-price'+len+'" placeholder="进价"></td>'+
			'<td><input type="text" class="layui-input" id="sy-price'+len+'" placeholder="收银价"></td>'+
			'<td><input type="text" class="layui-input" id="sy-price'+len+'" placeholder="会员价"></td>'+
			'<td><input type="text" class="layui-input" id="sc-price'+len+'" placeholder="商城价"></td>'+
			'<td><input type="text" class="layui-input" id="jf-price'+len+'" placeholder="积分价"></td>'+
			'<td><input type="text" class="layui-input" id="jf-txm'+len+'" placeholder="条形码"></td>'+
			'<td><a class="del-tab">删除</a></td>'+
			'</tr>'
		);
	});
	
	
	$('.article-button').on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，添加成功！',{icon: 6,time:1500});
	})
})