<?php
include_once '../../../Action/ProductAction.php';
include_once '../../../Action/ProductpriceitemsAction.php';
include_once '../../../Action/ProductdetailAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$product = new ProductAction();
$productpriceitems = new ProductpriceitemsAction();
$productdetail = new ProductdetailAction();
if($type=="list"){
	$productname = $postData['productname'];//产品名称
	$productno = $postData['productno'];//产品编号
	$typeid = $postData['typeid'];//产品分类
	if($typeid==""){
		$typeid=$postData['parentid'];
	}
	$status = $postData['status'];//状态0上架 1下架
	$ptype = $postData['ptype'];//产品类型 1、常规线  2、旅拍线 3、定制线
	$currentPage = $postData['currentPage'];//起始页
	$itemsPerPage = $postData['itemsPerPage'];//每页展示的数据条数
	$result = $product->ProductList($productno, $productname, $typeid,$ptype,$status, $currentPage, $itemsPerPage);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="del"){
	$id = $postData["ids"];
	if (is_array($id)){
		for ($i = 0; $i < count($id); $i++) {
			$condition["productid"] = $id[$i];
	        $data['state'] = 0;
			$data['modifyId'] = $_SESSION["adminuserid"];
	        $data['modifyDate'] = date('Y-m-d H:i:s', time());
			$result = $product->delproduct($data, $condition);//删除产品
			if($result>0){
				$where["productid"] = $id[$i];
		        $datas['state'] = 0;
				$datas['modifyId'] = $_SESSION["adminuserid"];
		        $datas['modifyDate'] = date('Y-m-d H:i:s', time());
				$priceitems = $productpriceitems->delPrice($data, $condition);//删除价格
				
				//删除行程天数
				$where["productid"] = $id[$i];
		        $datas['state'] = 0;
				$datas['modifyId'] = $_SESSION["adminuserid"];
		        $datas['modifyDate'] = date('Y-m-d H:i:s', time());
				$detail = $productdetail->delDetail($data, $condition);//删除行程天数
			}
		}
	}else{
		$condition["productid"] = $id;
        $data['state'] = 0;
		$data['modifyId'] = $_SESSION["adminuserid"];
        $data['modifyDate'] = date('Y-m-d H:i:s', time());
		$result = $product->delproduct($data, $condition);//删除产品
		if($result>0){
			$where["productid"] = $id;
	        $datas['state'] = 0;
			$datas['modifyId'] = $_SESSION["adminuserid"];
	        $datas['modifyDate'] = date('Y-m-d H:i:s', time());
			$priceitems = $productpriceitems->delPrice($data, $condition);//删除价格
			
			//删除行程天数
			$where["productid"] = $id;
	        $datas['state'] = 0;
			$datas['modifyId'] = $_SESSION["adminuserid"];
	        $datas['modifyDate'] = date('Y-m-d H:i:s', time());
			$detail = $productdetail->delDetail($data, $condition);//删除行程天数
		}
	}
	exit(json_encode($result));
}else if($type=="downOrUp"){
	$productid = $postData["productid"];
	$status = $postData["status"];
	
	$condition["productid"] = $productid;
    $data['status'] = $status;
    $data['modifyId'] = $_SESSION["adminuserid"];
    $data['modifyDate'] = date('Y-m-d H:i:s', time());
	$result = $product->updown($data, $condition);//上、下架产品
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