<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2016/10/15
 * Time: 9:53
 * 公用方法
 */
//服务端接口数据交互
function http($url, $data = NULL, $json = false)//data:三维数组,转成JSON格式{datas:{page:1,pagesiz:10}}, json:是否用JSON传输 1：是 0：否
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    if (!empty($data)) {
        if ($json && is_array($data)) {
            $data = json_encode($data);
        }
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        if ($json) { //json=1,发送JSON数据
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length:' . strlen($data))
            );
        }
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    $errorno = curl_errno($curl);
    if ($errorno) {
        return array('errorno' => false, 'errmsg' => $errorno);
    }
    curl_close($curl);
    return json_decode($res, true);
}
//post方式抓取API接口信息
function postData($url, $jsonStr)//$url=抓取地址   $jsonStr=数组
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonStr));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json;',
			'Content-Length: ' . strlen(json_encode($jsonStr))
		)
	);
	$response = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	return json_decode($response, true);//array($response);
}
//get方式获取API接口信息
function getData($url)//$url=抓取地址
{
	$info = file_get_contents($url);
	return json_decode($info);
}
//微信post方式抓取数据
function curlPost($url,$params){
	$ch = curl_init();
	$timeout = 5;
	curl_setopt ($ch, CURLOPT_URL, $url); //发贴地址
	curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));//设置header属性
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
	$file_contents = curl_exec($ch);//获得返回值
	curl_close($ch);
	return $file_contents;
}
//公共函数
function rounded($s,$number){
	$s = trim(strval($s));
	if (preg_match('#^-?\d+?\.0+$#', $s)) {
		$num = preg_replace('#^(-?\d+?)\.0+$#','$1',$s);
		$arr=explode(".",$num);
		if($number==2){
			return number_format($num, 2, '.', '');
		}
	}
	if (preg_match('#^-?\d+?\.[0-9]+?0+$#', $s)) {
		$num = preg_replace('#^(-?\d+\.[0-9]+?)0+$#','$1',$s);
		$arr=explode(".",$num);
		if($number==2){
			return number_format($num, 2, '.', '');
		}
	}
	if($s=="0"){
		$num = number_format($s, 2, '.', '');
	}else if(strlen($s)==1 || strlen($s)==2 || strlen($s)==3){
		$num = number_format($s, 2, '.', '');
	}else if($number==2){
		$num = number_format($s, $number, '.', '');
	}else{
		$arr=explode(".",$num);
		if(strlen($arr[1])>7){
			$num = number_format($s, $number, '.', '');
		}else if(strlen($num)==1 || strlen($num)==2 || strlen($num)==3){
			$num = number_format($num, 2, '.', '');
		}else if($number==2){
			$num = number_format($num, $number, '.', '');
		}else if($number==2){
			$num = number_format($num, $number, '.', '');
		}else{
			if(strlen($arr[1])>7){
				$num = number_format($s, $number, '.', '');
			}else{
				/* $num=preg_replace('#^(-?\d+\.[0-9]+?)0+$#','$1',$s);
				$arr=explode(".",$num);
				if(strlen($arr[1])>7){
					$m = number_format($s, $number, '.', '');
					$num=preg_replace('#^(-?\d+\.[0-9]+?)0+$#','$1',$m);
				}else{
					$m = number_format($s, $number, '.', '');
					$num=preg_replace('#^(-?\d+\.[0-9]+?)0+$#','$1',$m);
				} */
				$m = number_format($s, $number, '.', '');
				$num=preg_replace('#^(-?\d+\.[0-9]+?)0+$#','$1',$m);
			}
		}
	}
	return $num;
}
function udate($format = 'u', $utimestamp = null) {
	if (is_null($utimestamp))
		$utimestamp = microtime(true);

		$timestamp = floor($utimestamp);
		$milliseconds = round(($utimestamp - $timestamp) * 1000);

		return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
}
//微信get方式抓取数据
function curlGet($url,$method,$data){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$temp = curl_exec($ch);
	return $temp;
}
// 将数据按照所属关系封装 见图2  
function arr2tree($tree, $rootId = 0) {  
    $return = array();  
    foreach($tree as $leaf) {  
        if($leaf['praentid'] == $rootId) {  
            foreach($tree as $subleaf) {  
                if($subleaf['praentid'] == $leaf['typeid']) {
                    $leaf['children'] = arr2tree($tree, $leaf['typeid']);
                    break;  
                }  
            }  
            $return[] = $leaf;  
        }  
    }  
    return $return;  
} 
function tree2html($tree) {  
    $str = ' ';  
    foreach($tree as $leaf) {  
        $str .='<option value="'.$leaf["typeid"].'">├ '.$leaf['typename'].'</option>'; 
        if(!empty($leaf['children'])) tree2html($leaf['children']);  
    } 
    return $str;
} 
?>
