<?php
include_once '../../../Action/Article_categoryAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$article_category = new Article_categoryAction();
if($type=="list"){
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $article_category->ArticleTypeList($currentPage, $itemsPerPage);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="del"){
	$id = $postData["ids"];
	$result = $article_category->del($id);//删除产品
	exit(json_encode($result));
}else if($type=="add"){
	$typeid = $postData["typeid"];
	$sn = $postData["sn"];
	$typename = $postData["typename"];
	$result = $article_category->add($typeid,$sn,$typename);//添加
	exit(json_encode($result));
}else if($type=="modify"){
	$typeid = $postData["typeid"];
	$sn = $postData["sn"];
	$typename = $postData["typename"];
	$result = $article_category->modify($typeid,$sn,$typename);//修改
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