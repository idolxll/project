<?php 
/** 
 * Created by PhpStorm. 
 * User: Administrator 
 * Date: 2016/6/28 
 * Time: 21:04 
 */
class upload{ 
   protected $fileMine;//文件上传类型 
   protected $filepath;//文件上传路径 
   protected $filemax;//文件上传大小 
   protected $fileExt;//文件上传格式 
   protected $filename;//文件名 
   protected $fileerror;//文件出错设置 
   protected $fileflag;//文件检测 
   protected $fileinfo; //FILES 
   protected $ext; //文件扩展 ,
   protected $path;
   protected $Smallpath; 
  //文件上传 
  public function __construct($filename="file",$filemax=20000000,$fileflag=true,$fileExt=array('jpg','JPG','jpeg','JPEG','png','gif'),$fileMine=array('image/jpeg','image/png')) 
  { 
    $this->filename=$filename; 
    //$this->fileinfo=$_FILES[$this->filename];
    $this->fileinfo=$_FILES; 
    $this->filemax=$filemax; 
    $this->fileflag=$fileflag; 
    $this->fileExt=$fileExt; 
    $this->fileMine=$fileMine; 
    //var_dump($this->filename); 
  } 
  //错误判断 
  public function UpError(){ 
  	  if(count($this->fileinfo[$this->filename]["error"])>1){
  	  	$errorarr = $this->fileinfo[$this->filename]["error"];
  	  	for($i = 0;$i<count($errorarr); $i++){
  	  		if($errorarr[$i]>0){ 
  	  			switch($errorarr[$i]) 
		        { 
		          case 1: 
		          $this->fileerror="上传文件大小超过服务器允许上传的最大值，php.ini中设置upload_max_filesize选项限制的值 "; 
		            break; 
		          case 2: 
		            $this->fileerror="上传文件大小超过HTML表单中隐藏域MAX_FILE_SIZE选项指定的值"; 
		            break; 
		          case 3: 
		            $this->fileerror="文件部分被上传"; 
		            break; 
		          case 4: 
		            $this->fileerror="没有选择上传文件"; 
		            break; 
		          case 5: 
		            $this->fileerror="未找到临时目录"; 
		            break; 
		          case 6: 
		            $this->fileerror="文件写入失败"; 
		            break; 
		          case 7: 
		            $this->fileerror="php文件上传扩展没有打开 "; 
		            break; 
		          case 8: 
		            $this->fileerror=""; 
		            break; 
		        } 
		        return false;  
  	  		}
  	  	}
  	  }else{
	      if($this->fileinfo[$this->filename]['error']>0){ 
		        switch($this->fileinfo[$this->filename]['error']) 
		        { 
		          case 1: 
		          $this->fileerror="上传文件大小超过服务器允许上传的最大值，php.ini中设置upload_max_filesize选项限制的值 "; 
		            break; 
		          case 2: 
		            $this->fileerror="上传文件大小超过HTML表单中隐藏域MAX_FILE_SIZE选项指定的值"; 
		            break; 
		          case 3: 
		            $this->fileerror="文件部分被上传"; 
		            break; 
		          case 4: 
		            $this->fileerror="没有选择上传文件"; 
		            break; 
		          case 5: 
		            $this->fileerror="未找到临时目录"; 
		            break; 
		          case 6: 
		            $this->fileerror="文件写入失败"; 
		            break; 
		          case 7: 
		            $this->fileerror="php文件上传扩展没有打开 "; 
		            break; 
		          case 8: 
		            $this->fileerror=""; 
		            break; 
		        } 
		        return false; 
	      } 
  	  }
      return true; 
  } 
  //检测文件类型 
  public function UpMine(){ 
  	if(count($this->fileinfo[$this->filename]['type'])>1){
  		$typearr = $this->fileinfo[$this->filename]["type"];
  	  	for($i = 0;$i<count($typearr); $i++){
  	  		if(!in_array($typearr[$i],$this->fileMine)) { 
		      $this->error="文件上传类型不对"; 
		      return false; 
		    } 
  	  	}
  	}else {
  	  		if(!in_array($this->fileinfo[$this->filename]['type'],$this->fileMine)) { 
		      $this->error="文件上传类型不对"; 
		      return false; 
		    } 
  	}
    return true; 
  
  } 
  //检测文件格式 
  public function UpExt(){ 
  		if(count($this->fileinfo[$this->filename]['name'])>1){
	  		$namearr = $this->fileinfo[$this->filename]["name"];
	  	  	for($i = 0;$i<count($namearr); $i++){
	  	  		$this->ext=pathinfo($namearr[$i],PATHINFO_EXTENSION); 
			    //var_dump($ext); 
			    if(!in_array($this->ext,$this->fileExt)){ 
			      $this->fileerror="文件格式不对"; 
			      return false; 
			    }
	  	  	}
	  	}else {
	  	  		$this->ext=pathinfo($this->fileinfo[$this->filename]['name'],PATHINFO_EXTENSION); 
			    //var_dump($ext); 
			    if(!in_array($this->ext,$this->fileExt)){ 
			      $this->fileerror="文件格式不对"; 
			      return false; 
			    } 
	  	}
	    return true; 
  } 
  //检测文件路径 
  public function UpPath($type){ 
    if(!file_exists($this->filepath)){ 
      mkdir($this->filepath,0777,true); 
    } 
    $this->filepath = $this->filepath . $type . "/" . date("Ym",time());//年份和日期
    if(!file_exists($this->filepath)){ 
      mkdir($this->filepath,0777,true); 
    } 
    $this->filepath = $this->filepath . "/" . date("d",time());//日期
    if(!file_exists($this->filepath)){ 
      mkdir($this->filepath,0777,true); 
    } 
  } 
  //检测文件大小 
  public function UpSize(){ 
  		if(count($this->fileinfo[$this->filename]['size'])>1){
	  		$sizearr = $this->fileinfo[$this->filename]["size"];
	  	  	for($i = 0;$i<count($sizearr); $i++){
	  	  		$max=$sizearr[$i]; 
			    if($max>$this->filemax){ 
			      $this->fileerror="文件过大"; 
			      return false; 
			    }
	  	  	}
	  	}else {
	  	  		$max=$this->fileinfo[$this->filename]['size']; 
			    if($max>$this->filemax){ 
			      $this->fileerror="文件过大"; 
			      return false; 
			    } 
	  	}
    return true; 
  } 
  //检测文件是否HTTP 
  public function UpPost(){ 
	  if(count($this->fileinfo[$this->filename]['tmp_name'])>1){
	  		$tmp_namearr = $this->fileinfo[$this->filename]["tmp_name"];
	  	  	for($i = 0;$i<count($tmp_namearr); $i++){
	  	  		if(!is_uploaded_file($tmp_namearr[$i])){ 
				      $this->fileerror="恶意上偿还"; 
				      return false; 
			    }
	  	  	}
	  	}else {
	  	  		if(!is_uploaded_file($this->fileinfo[$this->filename]['tmp_name'])){ 
				      $this->fileerror="恶意上偿还"; 
				      return false; 
			    } 
	  	}
	  	return true;
  } 
  //文件名防止重复 
  public function Upname(){ 
    return md5(uniqid(microtime(true),true)); 
  } 
  //图片缩略图 
  public function Smallimg($imgpath,$file,$x=100,$y=100){ 
  	$this->filename = $file;
  	$this->filepath = $imgpath;
  	$this->UpPath("s"); 
    $names=$this->Upname(); 
    $this->Smallpath=$this->filepath.'/'. $names.'.'.$this->ext; 
    $imgAtt=getimagesize($this->path); 
    //图像宽，高，类型 
    $imgWidth=$imgAtt[0]; 
    $imgHeight=$imgAtt[1]; 
    $imgext=$imgAtt[2]; 
    //等比列缩放 
    if(($x/$imgWidth)>($y/$imgHeight)){ 
      $bl=$y/$imgHeight; 
    }else{ 
      $bl=$x/$imgWidth; 
    } 
    $x=floor($imgWidth*$bl); //缩放后 
    $y=floor($imgHeight*$bl); 
    $images=imagecreatetruecolor($x,$y); 
    $big=imagecreatefromjpeg($this->path); 
    imagecopyresized($images,$big,0,0,0,0,$x,$y,$imgWidth,$imgWidth); 
    switch($imgext){ 
      case 1: 
        $imageout=imagecreatefromgif($this->path); 
        break; 
      case 2: 
        $imageout=imagecreatefromjpeg($this->path); 
        break; 
      case 3: 
        $imageout=imagecreatefromgif($this->path); 
        break; 
    } 
    $im=imagejpeg($images,$this->Smallpath); 
    return $this->Smallpath; 
  } 
  //文件上传 
  public function uploads($imgpath,$file) 
  { 
  	$this->filename = $file;
  	$this->filepath = $imgpath;
    if($this->UpError()&&$this->UpMine()&&$this->UpExt()&&$this->UpSize()&&$this->UpPost()){ 
      $this->UpPath("b"); 
      $pathstr = "";
      if(count($this->fileinfo[$this->filename]["tmp_name"])>1){
      		$tmp_namearr = $this->fileinfo[$this->filename]["tmp_name"];
	  	  	for($i = 0;$i<count($tmp_namearr); $i++){
					if(is_uploaded_file($tmp_namearr[$i])){
							//$save=$path.$_FILES['images']['name'][$k];
							$names=$this->Upname(); 
			      			$this->path=$this->filepath.'/'. $names.'.'.$this->ext; 
			      			if(move_uploaded_file($tmp_namearr[$i],$this->path)){
								$pathstr .= $this->path . ","; 
							}else{ 
						        $this->fileerror="上传失败"; 
						    }
					}
			    }
	    }else{
	    		$names=$this->Upname(); 
      			$this->path=$this->filepath.'/'. $names.'.'.$this->ext; 
      			if(move_uploaded_file($this->fileinfo[$this->filename]['tmp_name'],$this->path)){
					$pathstr .= $this->path . ","; 
				}else{ 
			        $this->fileerror="上传失败"; 
			    }
		}
		return $this->path = rtrim($pathstr,",");
      /*if(move_uploaded_file($this->fileinfo['tmp_name'], $this->path)){ 
        return $this->path; 
      }else{ 
        $this->fileerror="上传失败"; 
      } */
    }else{ 
      return $this->fileerror;
    } 
  } 
} 
?>