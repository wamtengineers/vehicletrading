<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["model_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO model (make_id, title, sortorder) VALUES ('".slash($make_id)."', '".slash($title)."', '".slash($sortorder)."')";
		doquery($sql,$dblink);
		unset($_SESSION["model_manage"]["add"]);
		header('Location: model_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["model_manage"]["add"][$key]=$value;
		header('Location: model_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}