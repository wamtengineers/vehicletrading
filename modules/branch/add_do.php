<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["branch_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO branch (title) VALUES ('".slash($title)."')";
		doquery($sql,$dblink);
		unset($_SESSION["branch_manage"]["add"]);
		header('Location: branch_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["branch_manage"]["add"][$key]=$value;
		header('Location: branch_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}