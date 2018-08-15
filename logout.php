<?php 
	include("common.inc.php");
	session_destroy();
	setcookie("username",null,-1);

	array_map("unlink", glob("img/upload/revert/*.*"));
	if(is_dir("img/upload/revert")) rmdir("img/upload/revert/");

	header('Location: index.php');
 ?>