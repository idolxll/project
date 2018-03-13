/*
* @description: 员工管理js
* @author: will
* @update: will (2017-03-14 17:00)
* @version: v1.0
*/
$(function(){
	/*新增员工弹出层*/
	$('.new-btn').on('click', function(){
		layer.open({
			type: 1,
			title: "新增员工",//标题
			area: ['480px', '190px'],//宽高
			shadeClose: true, //点击遮罩关闭
			resize: false, //禁止拉伸
			content: $(".staff-popup"),//也可将html写在此处
		});
	});
	
	function isPhoneNo(phone) {
		var m_phone = /^[1][34578][0-9]{9}$/;
		return m_phone.test(phone);
	}
	/*新增员工成功，关闭弹层并提示*/
	$(".staff-btn").on("click", function(){
		var store = $("#store").val();
		var post = $("#post").val();
		var name = $("#name").val();
		var phone = $("#phone").val();
		if(store == 0){
			layer.msg('请选择员工所属门店！',{time:1500});
		}else if (post == 0) {
			layer.msg('请选择员工岗位！',{time:1500});
		}else if (name == "") {
			layer.msg('请填写员工姓名！',{time:1500});
		}else if (phone == "") {
			layer.msg('请填写员工手机号码！',{time:1500});
		}else if (!isPhoneNo(phone)) {
			layer.msg('请输入正确的手机号码！',{time:1500});
		}else {
			layer.closeAll('page'); //关闭弹层
			layer.msg('恭喜你，成功增加一名员工！',{icon: 6,time:1000});
		}
	});
	
	/*删除提示*/
	$(".del-btn").on("click", function(){
		layer.alert('亲，您确定删除该员工吗？', {
			icon: 5,
			title: "删除",
			resize: false, //禁止拉伸
		}, function(index){
			layer.msg('删除成功！',{icon: 6,time:1000});
		});
	});
})