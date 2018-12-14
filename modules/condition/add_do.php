<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["make_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO make (title, sortorder) VALUES ('".slash($title)."', '".slash($sortorder)."')";
		doquery($sql,$dblink);
		unset($_SESSION["make_manage"]["add"]);
		header('Location: make_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["make_manage"]["add"][$key]=$value;
		header('Location: make_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}