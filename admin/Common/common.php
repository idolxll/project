<?php 
error_reporting(E_ALL&!E_WARNING);
session_start();
if(empty($_SESSION['adminuserid'])){
	header('Location:http://'.$_SERVER['SERVER_NAME'].'/admin/login.php');
	return false;
}
?>