<?php
session_start();
$_SESSION['log_fail']++;
if ($_SESSION['log_fail'] == 3) {
	setcookie("login_fail", "true", time() + 10);
	$_SESSION['msg'] = "Your acoount has been locked for 10 mins";
	header('Location: login.php?error=Your acoount has been locked for 10 mins');
	;
} else {
	header('Location: login.php?error=Invalied Email or Password!');
	;
}