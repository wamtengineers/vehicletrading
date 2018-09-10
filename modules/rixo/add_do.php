<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["rixo_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO rixo (branch_id, title, phone, date, price, sortorder, comments) VALUES ('".$_SESSION["current_branch_id"]."', '".slash($title)."', '".slash($phone)."', '".slash(date_dbconvert($date))."', '".slash($price)."', '".slash($sortorder)."', '".slash($comments)."')";
		doquery($sql,$dblink);
		unset($_SESSION["rixo_manage"]["add"]);
		header('Location: rixo_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["rixo_manage"]["add"][$key]=$value;
		header('Location: rixo_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}