<?php
include_once '../../../Action/OdrorderAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$order = new OdrorderAction();
if($type=="list"){
	$realName = $postData['realName'];//姓名
	$mobile = $postData['mobile'];//手机号
	$startDate = $postData['startDate'];//开始时间
	$endDate = $postData['endDate'];//结束时间
	$orderno = $postData['orderno'];//订单号
	$orderState = $postData['orderState'];//订单状态
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $order->OrderList($realName, $mobile,$startDate,$endDate,$orderno,$orderState, $currentPage, $itemsPerPage);
	exit(json_encode($result));
}else if($type=="billtlist"){
	$realName = $postData['realName'];//姓名
	$mobile = $postData['mobile'];//手机号
	$startDate = $postData['startDate'];//开始时间
	$endDate = $postData['endDate'];//结束时间
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $order->OdrorderList($realName, $mobile,$startDate,$endDate, $currentPage, $itemsPerPage);
	exit(json_encode($result));
}else if($type=="look"){
	$orderid = $postData['orderid'];//订单ID
	$result = $order->orderinfo($orderid);
	exit(json_encode($result));
}else if($type=="del"){
	$id = $postData["ids"];
	if (is_array($id)){
		for ($i = 0; $i < count($id); $i++) {
			$result = $order->del($id[$i]);//删除产品
		}
	}else{
		$result = $order->del($id);//删除产品
	}
	exit(json_encode($result));
}else{
	//输出数据
	$output = array(
	    'Message' => "服务端异常", //消息提示，客户端常会用此作为给弹窗信息。
		'success' => 0
	);
	exit(json_encode($output));
}
//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
?>