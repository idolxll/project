<?php
require '../../Common/upload.func.php'; 
include_once '../../../Action/ProductAction.php';
include_once '../../../Action/ProductTypeAction.php';
include_once '../../../Action/ProductpriceitemsAction.php';
include_once '../../../Action/ProductdetailAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$product = new ProductAction();
$producttype = new ProductTypeAction();
$productpriceitems = new ProductpriceitemsAction();
$productdetail = new ProductdetailAction();
if($type=="add"){
	$productname = $postData['productname'];//产品名称
	$productno = $postData['productno'];//产品编号
	$typeid = $postData['typeid'];//产品分类
	$price = $postData['price'];//会员价
	$thumbnail = $postData['thumbnail'];//缩略图
	$img = $postData['img'];
	$market = $postData['market'];//市场价
	$Share_amount = $postData['Share_amount'];//一级分润
	$status = $postData['status'];//是否上架
	$is_top = $postData['is_top'];//是否置顶
	$is_red = $postData['is_red'];//是否推荐
	$is_hot = $postData['is_hot'];//是否热门
	$sn = $postData['sn'];//排序
	$seo_title = $postData['seo_title'];//SEO标题
	$seo_keywords = $postData['seo_keywords'];//SEO关键字
	$seo_description = $postData['seo_description'];//SEO描述
	$xcdays = $postData['xcdays'];//行程天数
	$jtfs = $postData['jtfs'];//交通方式
	$ftfs = $postData['ftfs'];//发团方式
	$xcts = $postData['xcts'];//产品特色
	$instructions = $postData['instructions'];//预定须知
	$description = $postData['description'];//线路描述
	$recommend = $postData['recommend'];//推荐理由
    $month = $postData['month'];//适合出游的月份
	$sales = $postData['sales']?$postData['sales']:0;//销量
	$ptype = $postData['ptype'];//产品类型
	$state = $postData['state'];//逻辑删除
	$valid = $postData['valid'];//物理删除
	if($productname==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品名称";
		exit(json_encode($info));
	}
	if($productno==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品编号";
		exit(json_encode($info));
	}
	if($typeid==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品类型";
		exit(json_encode($info));
	}
	if($price==""){
		$info["code"] = - 1;
		if($ptype==1){
			$info["message"] = "请输入会员价";
		}else{
			$info["message"] = "请输入参考价";
		}
		exit(json_encode($info));
	}
	if($market=="" && $ptype==1){
		$info["code"] = - 1;
		$info["message"] = "请输入市场价";
		exit(json_encode($info));
	}
	if($Share_amount==""){
		$info["code"] = - 1;
		$info["message"] = "请输入分润金额";
		exit(json_encode($info));
	}
	if($xcdays==""){
		$info["code"] = - 1;
		$info["message"] = "请输入行程天数";
		exit(json_encode($info));
	}
	if($description==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品描述";
		exit(json_encode($info));
	}
	if($xcts==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品特色";
		exit(json_encode($info));
	}
	if($instructions==""){
		$info["code"] = - 1;
		$info["message"] = "请输入预定须知";
		exit(json_encode($info));
	}
	$data['productname'] = $productname;
	$data['productno'] = $productno;
	$data['typeid'] = $typeid;
	$data['price'] = $price;
	$data['thumbnail'] = $thumbnail;
	$data['img'] = $img;
	$data['market'] = $market;
	$data['Share_amount'] = $Share_amount;
	$data['status'] = $status;
	$data['is_top'] = $is_top;
	$data['is_red'] = $is_red;
	$data['is_hot'] = $is_hot;
	$data['sn'] = $sn;
	$data['seo_title'] = $seo_title;
	$data['seo_keywords'] = $seo_keywords;
	$data['seo_description'] = $seo_description;
	$data['xcdays'] = $xcdays;
	$data['jtfs'] = $jtfs;
	$data['ftfs'] = $ftfs;
	$data['xcts'] = $xcts;
	$data['instructions'] = $instructions;
	$data['description'] = $description;
	$data['type'] = $ptype;
	$data['month'] = $month;
    $data['recommend'] = $recommend;
	$data['sales'] = $sales;
	$data['state'] = $state;
	$data['valid'] = $valid;
	$data['createId'] = $_SESSION["adminuserid"];//操作人
	$data['createDate'] = date("Y-m-d H:i:s",time());//操作时间
	$result = $product->add($data);
	if($result["code"]>0){//执行成功开始添加金额
		$priceitems["productid"] = $result["code"];
		$priceitems["xcdays"] = $xcdays;
		$priceitems["datelist"] = $postData['datelist'];
		$priceitems["pricelist"] = $postData['pricelist'];
		$priceitems["marketpricelist"] = $postData['marketpricelist'];
		$priceitems['createId'] = $_SESSION["adminuserid"];//操作人
		$priceitems['createDate'] = date("Y-m-d H:i:s",time());//操作时间
		if($postData['datelist']!=""){
			$result = $productpriceitems->add($priceitems);
		}
		
		//行程天数
		$dataline["productid"] = $result["code"];
		$dataline["title"] = $postData['linedaytitlelist'];
		$dataline["outline"] = $postData['linetitlelist'];
		$dataline["description"] = $postData['linedaylist'];
		$dataline['createId'] = $_SESSION["adminuserid"];//操作人
		$dataline['createDate'] = date("Y-m-d H:i:s",time());//操作时间
		$res = $productdetail->add($dataline);
	}
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="modify"){
	$productid = $postData['productid'];//产品ID
	$productname = $postData['productname'];//产品名称
	$productno = $postData['productno'];//产品编号
	$typeid = $postData['typeid'];//产品分类
	$price = $postData['price'];//会员价
	$thumbnail = $postData['thumbnail'];//缩略图
	$img = $postData['img'];
	$imglist = $postData['imglist'];
	$market = $postData['market'];//市场价
	$Share_amount = $postData['Share_amount'];//一级分润
	$status = $postData['status'];//是否上架
	$is_top = $postData['is_top'];//是否置顶
	$is_red = $postData['is_red'];//是否推荐
	$is_hot = $postData['is_hot'];//是否热门
	$sn = $postData['sn'];//排序
	$seo_title = $postData['seo_title'];//SEO标题
	$seo_keywords = $postData['seo_keywords'];//SEO关键字
	$seo_description = $postData['seo_description'];//SEO描述
	$xcdays = $postData['xcdays'];//行程天数
	$jtfs = $postData['jtfs'];//交通方式
	$ftfs = $postData['ftfs'];//发团方式
	$xcts = $postData['xcts'];//产品特色
	$instructions = $postData['instructions'];//预定须知
	$description = $postData['description'];//线路描述
	$recommend = $postData['recommend'];//推荐理由
    $month = $postData['month'];//适合出游的月份
	$sales = $postData['sales']?$postData['sales']:0;//销量
	$ptype = $postData['ptype'];//产品类型
	$state = $postData['state'];//逻辑删除
	$valid = $postData['valid'];//物理删除
	if($productname==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品名称";
		exit(json_encode($info));
	}
	if($productno==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品编号";
		exit(json_encode($info));
	}
	if($typeid==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品类型";
		exit(json_encode($info));
	}
	if($price==""){
		$info["code"] = - 1;
		if($ptype==1){
			$info["message"] = "请输入会员价";
		}else{
			$info["message"] = "请输入参考价";
		}
		exit(json_encode($info));
	}
	if($market=="" && $ptype==1){
		$info["code"] = - 1;
		$info["message"] = "请输入市场价";
		exit(json_encode($info));
	}
	if($Share_amount==""){
		$info["code"] = - 1;
		$info["message"] = "请输入分润金额";
		exit(json_encode($info));
	}
	if($xcdays==""){
		$info["code"] = - 1;
		$info["message"] = "请输入行程天数";
		exit(json_encode($info));
	}
	if($description==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品描述";
		exit(json_encode($info));
	}
	if($xcts==""){
		$info["code"] = - 1;
		$info["message"] = "请输入产品特色";
		exit(json_encode($info));
	}
	if($instructions==""){
		$info["code"] = - 1;
		$info["message"] = "请输入预定须知";
		exit(json_encode($info));
	}
	$condition['productid'] = $productid;
	$data['productname'] = $productname;
	$data['productno'] = $productno;
	$data['typeid'] = $typeid;
	$data['price'] = $price;
	$data['thumbnail'] = $thumbnail;
	$data['img'] = $img;
	$data['imglist'] = $imglist;
	$data['market'] = $market;
	$data['Share_amount'] = $Share_amount;
	$data['status'] = $status;
	$data['is_top'] = $is_top;
	$data['is_red'] = $is_red;
	$data['is_hot'] = $is_hot;
	$data['sn'] = $sn;
	$data['seo_title'] = $seo_title;
	$data['seo_keywords'] = $seo_keywords;
	$data['seo_description'] = $seo_description;
	$data['xcdays'] = $xcdays;
	$data['jtfs'] = $jtfs;
	$data['ftfs'] = $ftfs;
	$data['xcts'] = $xcts;
	$data['instructions'] = $instructions;
	$data['description'] = $description;
	$data['type'] = $ptype;
	$data['month'] = $month;
    $data['recommend'] = $recommend;
	$data['sales'] = $sales;
	$data['state'] = $state;
	$data['valid'] = $valid;
	$data['modifyId'] = $_SESSION["adminuserid"];//操作人
	$data['modifyDate'] = date("Y-m-d H:i:s",time());//操作时间
	$result = $product->updateProduct($condition,$data);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	if($result["code"]>0){//执行成功开始添加金额
		$idlist = $postData['idlist'];
		$priceitems["datelist"] = $postData['datelist'];
		$priceitems["xcdays"] = $postData['xcdays'];
		$priceitems["pricelist"] = $postData['pricelist'];
		$priceitems["marketpricelist"] = $postData['marketpricelist'];
		$priceitems['productid'] = $productid;//产品编号
		$priceitems['modifyId'] = $_SESSION["adminuserid"];//操作人
		$priceitems['modifyDate'] = date("Y-m-d H:i:s",time());//操作时间
		$result = $productpriceitems->updateLine_price($idlist,$priceitems);
		
		$idlists = $postData['detailid'];
		$datelist["title"] = $postData['linedaytitlelist'];
		$datelist["outline"] = $postData['linetitlelist'];
		$datelist["description"] = $postData['linedaylist'];
		$datelist['productid'] = $productid;//产品编号
		$datelist['modifyId'] = $_SESSION["adminuserid"];//操作人
		$datelist['modifyDate'] = date("Y-m-d H:i:s",time());//操作时间
		$res = $productdetail->updateLine($idlists,$datelist);
	}
	exit(json_encode($result));
}else if($type=="searchtype"){
	$falg = $postData["falg"];
	if($falg=="1"){
		$list["list"] = $producttype->ProductType();
	}else if($falg=="3"){
		$list["list"] = $producttype->CustomType();
	}else{
		$list["list"] = $producttype->Type();
	}
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="searchproduct"){
	$productid = $postData["productid"];
	$list["list"] = $product->getProductInfo($productid);
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="selectType"){
	$parentid = $postData['parentid'];
	$list["list"] = $producttype->ParentProductType($parentid);
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
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