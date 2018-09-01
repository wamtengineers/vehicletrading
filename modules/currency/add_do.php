<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["currency_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO currency (title, symbol, `default`) VALUES ('".slash($title)."', '".slash($symbol)."', '".slash($default)."')";
		doquery($sql,$dblink);
		unset($_SESSION["currency_manage"]["add"]);
		header('Location: currency_manage.php?tab=list&msg='.url_encode("Sucessfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["currency_manage"]["add"][$key]=$value;
		header('Location: currency_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}