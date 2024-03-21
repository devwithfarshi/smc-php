<?php
session_start();
$_SESSION['log_fail']++;
if($_SESSION['log_fail']==3){
	setcookie("login_fail","true",time()+600);
	$_SESSION['log_fail']=0;
	$_SESSION['msg']="Your acoount has been locked for 10 mins";
}else{
	$_SESSION['msg']="Email or Password Wrong";
}
header('location: register.php');