<?php
include_once '../../../Action/MemwalletbalanceAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$memwalletbalance = new MemwalletbalanceAction();
if($type=="list"){
	$realName = $postData['realName'];//姓名
	$mobile = $postData['mobile'];//手机号
	$startDate = $postData['startDate'];//开始时间
	$endDate = $postData['endDate'];//结束时间
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $memwalletbalance->WalletbalanceList($realName, $mobile, $startDate,$endDate, $currentPage, $itemsPerPage);
	exit(json_encode($result));
}else if($type=="billtlist"){
	$uid = $postData['uid'];//用户编号
	$startDate = $postData['startDate'];//开始时间
	$endDate = $postData['endDate'];//结束时间
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $memwalletbalance->MemwalletbalanceList($uid, $startDate,$endDate, $currentPage, $itemsPerPage);
	exit(json_encode($result));
}else if($type=="del"){
	$id = $postData["ids"];
	if (is_array($id)){
		for ($i = 0; $i < count($id); $i++) {
			$result = $memwalletbalance->del($id[$i]);//删除流水
		}
	}else{
		$result = $memwalletbalance->del($id);//删除流水
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