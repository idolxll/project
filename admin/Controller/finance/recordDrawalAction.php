<?php
include_once '../../../Action/MemwalletbalanceAction.php';
include_once '../../../Action/MemCardAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$walletbalance = new MemwalletbalanceAction();
$memcard = new MemCardAction();
if($type=="list"){
	$result = $walletbalance->walletbalanceRows($postData);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="shenhe"){
	$result = $walletbalance->updateState($postData);//审核驳回
	exit(json_encode($result));
}else if($type=="pay"){
	$result = $walletbalance->updateState($postData);//审核驳回
	exit(json_encode($result));
}else if($type=="allshenhe"){
	$watIdlist = $postData["ids"];
	for($i = 0;$i<count($watIdlist); $i++){
		$data["balId"] = $watIdlist[$i];
		$data["status"] = 3;
		$result = $walletbalance->updateState($data);//审核通过
	}
	exit(json_encode($result));
	exit(json_encode($result));
}else if($type=="allpay"){
	$watIdlist = $postData["ids"];
	for($i = 0;$i<count($watIdlist); $i++){
		$data["balId"] = $watIdlist[$i];
		$data["status"] = 1;
		$result = $walletbalance->updateState($data);//支付
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