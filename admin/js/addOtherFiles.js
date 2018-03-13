/*
* @description: 添加支出项目
* @author: will
* @update: will (2017-03-24 19:00)
* @version: v1.0
*/
$(function(){
	/*添加成功关闭弹窗*/
	$(".add-btn").click(function(){
		var len=$(".layui-elem-field").length;
		if(len < 10){
			$(".aof-center").append(
				'<fieldset class="layui-elem-field"  id="field'+len+'">'+
				'<legend>收支项目</legend>'+
				'<div class="layui-field-box">'+
				'<div class="layui-form-item">'+
				'<label class="layui-form-label">项目名称</label>'+
				'<div class="layui-input-inline" style="width: 270px;">'+
				'<select class="layui-input">'+
				'<option value="0">请选择...</option>'+
				'<option value="1">门店租金</option>'+
				'<option value="2">员工工资</option>'+
				'<option value="3">物业费</option>'+
				'<option value="4">电费</option>'+
				'<option value="5">水费</option>'+
				'<option value="6">其他收支</option>'+
				'</select>'+
				'</div>'+
				'</div>'+
				'<div class="layui-form-item" style="margin-top: 10px;">'+
				'<label class="layui-form-label">&#12288;&#12288;费用</label>'+
				'<div class="layui-input-inline" style="width: 270px;">'+
				'<input type="text" class="layui-input" placeholder="请输入支出项目名称">'+
				'</div>'+
				'</div>'+
				'<div class="layui-form-item" style="margin-top: 10px;">'+
				'<label class="layui-form-label">&#12288;&#12288;备注</label>'+
				'<div class="layui-input-inline" style="width: 270px;">'+
				'<input type="text" class="layui-input" placeholder="请输入支出项目名称">'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</fieldset>'
			);
		}	
	});
	
	$(".del-btn").click(function(){
		var len=$(".layui-elem-field").length;
		if(len > 1){
			$(".layui-elem-field[id='field"+(len-1)+"']").remove(); 
		}
	});
	
	
	$(".add-submit").on("click", function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
		parent.layer.msg('恭喜你，添加成功！',{icon: 6,time:1500});
	})
})
