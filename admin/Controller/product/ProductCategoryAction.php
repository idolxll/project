<?php
include_once '../../../Action/ProductTypeAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$producttype = new ProductTypeAction();
if($type=="list"){
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $producttype->ProducttypeList($currentPage, $itemsPerPage);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="del"){
	$id = $postData["ids"];
	$result = $producttype->del($id);//删除产品
	exit(json_encode($result));
}else if($type=="add"){
	$typeid = $postData["typeid"];
	$orderby = $postData["orderby"];
	$typename = $postData["typename"];
	$is_hot = $postData["is_hot"] ? 1 : 0;
	$img = $postData['img'];
	$initial=$postData['initial'];
	if($typeid==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品类型";
		exit(json_encode($info));
	}
	if($orderby==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品排序";
		exit(json_encode($info));
	}
	if($typename==""){
		$info["code"] = - 1;
		$info["message"] = "请输入分类名称";
		exit(json_encode($info));
	}
	$data['parentid'] = $typeid;
	$data['sn'] = $orderby;
	$data['typename'] = $typename;
	$data['is_hot'] = $is_hot;
    $data['state'] = 1;
	$data['valid'] = 1;
	$data['createId'] = $_SESSION["adminuserid"];
    $data['createDate'] = date('Y-m-d H:i:s', time());
	$result = $producttype->add($data);//添加
	exit(json_encode($result));
}else if($type=="modify"){
	$typeid = $postData["typeid"];
	$orderby = $postData["orderby"];
	$typename = $postData["typename"];
	$is_hot = $postData["is_hot"] ? 1 : 0;
	$initial=$postData['initial'];
	if($typeid==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品类型";
		exit(json_encode($info));
	}
	if($orderby==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品排序";
		exit(json_encode($info));
	}
	if($typename==""){
		$info["code"] = - 1;
		$info["message"] = "请输入分类名称";
		exit(json_encode($info));
	}
	$result = $producttype->modify($typeid,$orderby,$typename,$is_hot);//修改
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