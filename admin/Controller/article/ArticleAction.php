<?php
include_once '../../../Action/ArticleAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$article = new ArticleAction();
if($type=="list"){
	$title = $postData['title'];//文章名称
	$typeid = $postData['typeid'];//文章分类
	if($typeid==""){
		$typeid=$postData['parentid'];
	}
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $article->ArticleList($title, $typeid, $currentPage, $itemsPerPage);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="del"){
	$id = $postData["ids"];
	if (is_array($id)){
		for ($i = 0; $i < count($id); $i++) {
			$result = $article->del($id[$i]);//删除产品
		}
	}else{
		$result = $article->del($id);//删除产品
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