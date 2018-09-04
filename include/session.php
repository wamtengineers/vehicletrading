<?php
if(!isset($_SESSION["logged_in_admin"])){
	if(!check_admin_cookie()){
		header("Location: login.php");
		die;
	}	
}
if(!isset($_SESSION["current_branch_id"])){
	header("Location: branches.php");
	die;
}
?>