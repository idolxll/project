<?php
include_once '../../../Action/MemberAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$member = new MemberAction();
if($type=="list"){
	$realName = $postData['realName'];//姓名
	$mobile = $postData['mobile'];//手机号
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $member->MemberList($realName, $mobile, $currentPage, $itemsPerPage);
	exit(json_encode($result));
}else if($type=="memlist"){
	$realName = $postData['realName'];//姓名
	$mobile = $postData['mobile'];//手机号
	$owneruid = $postData['owneruid'];//手机号
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $member->OwnerList($owneruid, $realName, $mobile, $currentPage, $itemsPerPage);
	exit(json_encode($result));
}else if($type=="logout"){
	$id = $postData["id"];
	$result = $member->logout($id);//注销账户
	exit(json_encode($result));
}else if($type=="upgrade"){
	$condition["uid"] = $postData["id"];
	$data["vip"] = 1;
	$result = $member->updateMember($condition,$data);//升级
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