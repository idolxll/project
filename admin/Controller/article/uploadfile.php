<?php
require '../../Common/upload.func.php'; 
$ImgClass = new upload();
$img=$ImgClass->uploads("../../../userfiles/article/"); 
$Smallimg=$ImgClass->Smallimg("../../../userfiles/article/"); 
//输出数据
$output = array(
    'data' => array(
        'Smallimg' => $Smallimg,
		'filePath' => $img,
    ), 
    'info' => $Smallimg, //消息提示，客户端常会用此作为给弹窗信息。
);
exit(json_encode($output));