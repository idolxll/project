<?php
include_once '../../Action/SYSUserAction.php';
$postStr = file_get_contents("php://input");//获取表单数据
$postData = json_decode($postStr,true);
$type = $postData['type'];//操作类型
$sysuser = new SYSUserAction();
if($type=="login"){
	$uname = $postData['name'];
	$password = $postData['pwd'];
	$output = $sysuser->login($uname,$password);
	//file_put_contents("log.txt", "QWE信息：".var_export($output,TRUE)."\n", FILE_APPEND);
	exit(json_encode($output));
}
//file_put_contents("log.txt", "QWE信息：".var_export($output,TRUE)."\n", FILE_APPEND);
?>