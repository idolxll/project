<?php
include_once '../../../Action/ORGAgentAction.php';
include_once '../../../Action/ORGOperationCenterAction.php';
include_once '../../../Action/SYSUserAction.php';
include_once '../../../Action/SYSCityAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$ORGAgent = new ORGAgentAction();
$SYSUser = new SYSUserAction();
$SYSCity = new SYSCityAction();
$ORGOperationCenter = new ORGOperationCenterAction();
if($type=="list"){
	$status = $postData['status'];//状态 0、已到期 1、冻结 2、正常
	$mobile = $postData['mobile'];
	$cenId = $postData['cenId'];
	$realName = $postData['realName'];
	$proId = $postData['proId'];
	$cityId = $postData['cityId'];//市编号
	$startDate = $postData['startDate'];
	$endDate = $postData['endDate'];
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $ORGAgent->AgentList($status, $mobile,$cenId,$realName,$proId,$cityId,$startDate,$endDate, $currentPage, $itemsPerPage);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="searchtype"){
	$list["list"] = $SYSCity->get_provName();
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="selectType"){
	$proId = $postData['proId'];
	$list["list"] = $SYSCity->get_cityName($proId);
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="centerData"){
	$list["list"] = $ORGOperationCenter->CenterList('', '', 1,1000);
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="add"){
	$cenId = $postData['cenId'];//服务商ID
	$realName = $postData['realName'];//服务商名称
	$mobile = $postData['mobile'];//手机号码
	$password = $postData['password'];//密码
	$startDate = $postData['startDate'];//认证时间
	$endDate = $postData['endDate'];//到期时间
	$cenId = $postData['cId'];//所属运营中心
	$proId = $postData['proId'];//省编号
	$provice = $SYSCity->Get_name($proId);//查询省信息
	$cityId = $postData['cityId'];//市编号
	$city = $SYSCity->Get_name($cityId);//查询市信息
	$state = $postData['state'];//逻辑删除
	$valid = $postData['valid'];//物理删除
	if($cenId==""){
		$info["code"] = - 1;
		$info["message"] = "请选择所属运营中心";
		exit(json_encode($info));
	}
	if($realName==""){
		$info["code"] = - 1;
		$info["message"] = "请输入服务商";
		exit(json_encode($info));
	}
	if($mobile==""){
		$info["code"] = - 1;
		$info["message"] = "请输入手机号码";
		exit(json_encode($info));
	}
	if($startDate==""){
		$info["code"] = - 1;
		$info["message"] = "请输入开始时间";
		exit(json_encode($info));
	}
	if($endDate==""){
		$info["code"] = - 1;
		$info["message"] = "请输入结束时间";
		exit(json_encode($info));
	}
	if($proId==""){
		$info["code"] = - 1;
		$info["message"] = "请选择城市";
		exit(json_encode($info));
	}
	if($cityId==""){
		$info["code"] = - 1;
		$info["message"] = "请选择城市";
		exit(json_encode($info));
	}
	//查询手机号码是否被用
	$info = $SYSUser->getUserInfo("mobile='".$mobile."' and accountType=3 and state=1 and valid=1");
	if($info["mobile"]!=""){
		$info["code"] = - 1;
		$info["message"] = "您输入的手机被占用";
		exit(json_encode($info));
	}
	$datas['username'] = $realName;
	$datas['realName'] = $realName;
	$datas['password'] = strtoupper(substr(md5($password),8,16));
	$datas['mobile'] = $mobile;
	$datas['accountType'] = 3;
	$datas['loginTimes'] = 1;
	$datas['lastLoginDate'] = date("Y-m-d H:i:s",time());//操作时间
	$datas['status'] = 2;
	$datas['state'] = $state;
	$datas['valid'] = $valid;
	$datas['createId'] = $_SESSION["adminuserid"];//操作人
	$datas['createDate'] = date("Y-m-d H:i:s",time());//操作时间
	$result = $SYSUser->add($datas);
	if($result["code"]>0){
		$data['userId'] = $result["code"];
		$data['realName'] = $realName;
		$data['mobile'] = $mobile;
		$data['startDate'] = $startDate;
		$data['endDate'] = $endDate;
		$data['payType'] = "3";
		$data['proId'] = $proId;
		$data['cityId'] = $cityId;
		$data['city'] = $city;
		$data['provice'] = $provice;
		$data['cenId'] = $cenId;
		$data['status'] = 2;
		$data['state'] = $state;
		$data['valid'] = $valid;
		$data['createId'] = $_SESSION["adminuserid"];//操作人
		$data['createDate'] = date("Y-m-d H:i:s",time());//操作时间
		$result = $ORGAgent->add($data);
	}
	exit(json_encode($result));
}else if($type=="modify"){
	$userId = $postData['userId'];//用户ID
	$ageId = $postData['ageId'];//服务商ID
	$realName = $postData['realName'];//服务商名称
	$mobile = $postData['mobile'];//手机号码
	$startDate = $postData['startDate'];//认证时间
	$endDate = $postData['endDate'];//到期时间
	$state = $postData['state'];//逻辑删除
	$valid = $postData['valid'];//物理删除
	if($ageId==""){
		$info["code"] = - 1;
		$info["message"] = "服务商参数异常";
		exit(json_encode($info));
	}
	if($realName==""){
		$info["code"] = - 1;
		$info["message"] = "请输入服务商";
		exit(json_encode($info));
	}
	if($mobile==""){
		$info["code"] = - 1;
		$info["message"] = "请输入手机号码";
		exit(json_encode($info));
	}
	if($startDate==""){
		$info["code"] = - 1;
		$info["message"] = "请输入开始时间";
		exit(json_encode($info));
	}
	if($endDate==""){
		$info["code"] = - 1;
		$info["message"] = "请输入结束时间";
		exit(json_encode($info));
	}
	//查询手机号码是否被用
	$info = $SYSUser->getUserInfo("mobile='".$mobile."' and userId!='".$userId."' and accountType=3");
	if($info["mobile"]!=""){
		$info["code"] = - 1;
		$info["message"] = "您输入的手机被占用";
		exit(json_encode($info));
	}
	$where['userId'] = $userId;
	$datas['realName'] = $realName;
	$datas['mobile'] = $mobile;
	$datas['modifyId'] = $_SESSION["adminuserid"];//操作人
	$datas['modifyDate'] = date("Y-m-d H:i:s",time());//操作时间
	$res = $SYSUser->Update_User($datas,$where);
	if($res){
		$condition['ageId'] = $ageId;
		$data['realName'] = $realName;
		$data['mobile'] = $mobile;
		$data['startDate'] = $startDate;
		$data['endDate'] = $endDate;
		$data['modifyId'] = $_SESSION["adminuserid"];//操作人
		$data['modifyDate'] = date("Y-m-d H:i:s",time());//操作时间
		$res = $ORGAgent->UpadteInfo($data,$condition);
	}
	$result["code"] = $res;
	$result["message"] = '后台数据已经更新';
	exit(json_encode($result));
}else if($type=="解冻"){
	$userId= $postData["userId"];
	$ageId= $postData["ageId"];
	$condition["userId"] = $userId;
        $data['status'] = 2;
		$data['modifyId'] = $_SESSION["adminuserid"];
        $data['modifyDate'] = date('Y-m-d H:i:s', time());
		$result = $SYSUser->Update_User($data, $condition);//更新
		if($result>0){
			$where["ageId"] = $ageId;
	        $data['status'] = 2;
			$data['modifyId'] = $_SESSION["adminuserid"];
	        $data['modifyDate'] = date('Y-m-d H:i:s', time());
			$result = $ORGAgent->UpadteInfo($data, $condition);//更新
		}
	exit(json_encode($result));
}else if($type=="冻结"){
	$userId= $postData["userId"];
	$ageId= $postData["ageId"];
	$condition["userId"] = $userId;
        $data['status'] = 1;
		$data['modifyId'] = $_SESSION["adminuserid"];
        $data['modifyDate'] = date('Y-m-d H:i:s', time());
		$result = $SYSUser->Update_User($data, $condition);//更新
		if($result>0){
			$where["ageId"] = $ageId;
	        $data['status'] = 1;
			$datas['modifyId'] = $_SESSION["adminuserid"];
	        $datas['modifyDate'] = date('Y-m-d H:i:s', time());
			$result = $ORGAgent->UpadteInfo($data, $condition);//更新
		}
	exit(json_encode($result));
}else if($type=="resetPass"){
	$userId = $postData["userId"];
	$password = $postData["password"];
	
	$condition["userId"] = $userId;
    $data['password'] = strtoupper(substr(md5($password),8,16));
    $data['modifyId'] = $_SESSION["adminuserid"];
    $data['modifyDate'] = date('Y-m-d H:i:s', time());
	$result = $SYSUser->Update_User($data, $condition);//
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