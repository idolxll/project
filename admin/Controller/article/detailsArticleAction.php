<?php
require '../../Common/upload.func.php'; 
include_once '../../../Action/ArticleAction.php';
include_once '../../../Action/Article_categoryAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$article = new ArticleAction();
$article_category = new Article_categoryAction();
if($type=="add"){
	$title = $postData['title'];//文章标题
	$zhaiyao = $postData['zhaiyao'];//内容摘要
	$category_id = $postData['category_id'];//文章分类
	$click = $postData['click'];//点击次数
	$Smallimg = $postData['Smallimg'];//缩略图
	$img_url = $postData['img_url'];
	$call_index = $postData['call_index'];//调用别名
	$is_slide = $postData['is_slide'];//是否幻灯片
	$is_top = $postData['is_top'];//是否置顶
	$is_red = $postData['is_red'];//是否推荐
	$is_hot = $postData['is_hot'];//是否热门
	$orderby = $postData['orderby'];//排序
	$seo_title = $postData['seo_title'];//SEO标题
	$seo_keywords = $postData['seo_keywords'];//SEO关键字
	$seo_description = $postData['seo_description'];//SEO描述
	$content = $postData['content'];//文章内容
	$link_url = $postData['link_url'];//交通方式
	$state = $postData['state'];//逻辑删除
	$valid = $postData['valid'];//物理删除
	if($title==""){
		$info["code"] = - 1;
		$info["message"] = "请输入文章标题";
		exit(json_encode($info));
	}
	if($content==""){
		$info["code"] = - 1;
		$info["message"] = "请输入文章内容";
		exit(json_encode($info));
	}
	if($category_id==""){
		$info["code"] = - 1;
		$info["message"] = "请输入文章分类";
		exit(json_encode($info));
	}
	$data['title'] = $title;
	$data['abstract'] = $zhaiyao;
	$data['category_id'] = $category_id;
	$data['Smallimg'] = $Smallimg;
	$data['img_url'] = $img_url;
	$data['click'] = $click;
	$data['is_slide'] = $is_slide;
	$data['is_top'] = $is_top;
	$data['is_red'] = $is_red;
	$data['is_hot'] = $is_hot;
	$data['orderby'] = $orderby;
	$data['seo_title'] = $seo_title;
	$data['seo_keywords'] = $seo_keywords;
	$data['seo_description'] = $seo_description;
	$data['content'] = $content;
	$data['link_url'] = $link_url;
	$data['state'] = $state;
	$data['valid'] = $valid;
	$data['createId'] = $_SESSION["adminuserid"];//操作人
	$data['createDate'] = date("Y-m-d H:i:s",time());//操作时间
	$result = $article->add($data);
	exit(json_encode($result));
	//file_put_contents("log.txt", "信息：".var_export($starttime,TRUE)."\n", FILE_APPEND);
}else if($type=="modify"){
	$id = $postData['id'];//文章ID
	$title = $postData['title'];//文章标题
	$zhaiyao = $postData['zhaiyao'];//内容摘要
	$category_id = $postData['category_id'];//文章分类
	$click = $postData['click'];//点击次数
	$Smallimg = $postData['Smallimg'];//缩略图
	$img_url = $postData['img_url'];
	$call_index = $postData['call_index'];//调用别名
	$is_slide = $postData['is_slide'];//是否幻灯片
	$is_top = $postData['is_top'];//是否置顶
	$is_red = $postData['is_red'];//是否推荐
	$is_hot = $postData['is_hot'];//是否热门
	$orderby = $postData['orderby'];//排序
	$seo_title = $postData['seo_title'];//SEO标题
	$seo_keywords = $postData['seo_keywords'];//SEO关键字
	$seo_description = $postData['seo_description'];//SEO描述
	$content = $postData['content'];//文章内容
	$link_url = $postData['link_url'];//交通方式
	if($title==""){
		$info["code"] = - 1;
		$info["message"] = "请输入文章标题";
		exit(json_encode($info));
	}
	if($content==""){
		$info["code"] = - 1;
		$info["message"] = "请输入文章内容";
		exit(json_encode($info));
	}
	if($category_id==""){
		$info["code"] = - 1;
		$info["message"] = "请输入文章分类";
		exit(json_encode($info));
	}
	$condition['id'] = $id;
	$data['title'] = $title;
	$data['abstract'] = $zhaiyao;
	$data['category_id'] = $category_id;
	$data['Smallimg'] = $Smallimg;
	$data['img_url'] = $img_url;
	$data['click'] = $click;
	$data['is_slide'] = $is_slide;
	$data['is_top'] = $is_top;
	$data['is_red'] = $is_red;
	$data['is_hot'] = $is_hot;
	$data['orderby'] = $orderby;
	$data['seo_title'] = $seo_title;
	$data['seo_keywords'] = $seo_keywords;
	$data['seo_description'] = $seo_description;
	$data['content'] = $content;
	$data['link_url'] = $link_url;
	$data['createId'] = $_SESSION["adminuserid"];//操作人
	$data['createDate'] = date("Y-m-d H:i:s",time());//操作时间
	$result = $article->updateArticle($condition,$data);
	//file_put_contents("log.txt", "信息：".var_export($result,TRUE)."\n", FILE_APPEND);
	exit(json_encode($result));
}else if($type=="searchtype"){
	$list["list"] = $article_category->ArticleType();
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="searchproduct"){
	$id = $postData["id"];
	$list["list"] = $article->getArticleInfo($id);
	//file_put_contents("log.txt", "信息：".var_export($item,TRUE)."\n", FILE_APPEND);
	exit(json_encode($list));
}else if($type=="selectType"){
	$parentid = $postData['parentid'];
	$list["list"] = $article_category->ParentArticleType($parentid);
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