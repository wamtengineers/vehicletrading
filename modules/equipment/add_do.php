<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["equipment_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO equipment (title, sortorder) VALUES ('".slash($title)."', '".slash($sortorder)."')";
		doquery($sql,$dblink);
		unset($_SESSION["equipment_manage"]["add"]);
		header('Location: equipment_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["equipment_manage"]["add"][$key]=$value;
		header('Location: equipment_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}